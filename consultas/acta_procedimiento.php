<?php
require_once('../includes/fpdf.php');
require_once('../includes/conexion.php');
session_start();

class PDF extends FPDF
{
// Cabecera de p�gina
function Header()
{
    // Logo
    $this->Image('../recursos/logo.jpg',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // T�tulo
    $this->Cell(50,10,'Acta de Procedimiento',0,0,'C');
    // Salto de l�nea
    $this->Ln(20);
}

// Pie de p�gina
function Footer()
{
    // Posici�n: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // N�mero de p�gina
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
    var $flowingBlockAttr;

    function saveFont()
    {

        $saved = array();

        $saved[ 'family' ] = $this->FontFamily;
        $saved[ 'style' ] = $this->FontStyle;
        $saved[ 'sizePt' ] = $this->FontSizePt;
        $saved[ 'size' ] = $this->FontSize;
        $saved[ 'curr' ] =& $this->CurrentFont;

        return $saved;

    }

    function restoreFont( $saved )
    {

        $this->FontFamily = $saved[ 'family' ];
        $this->FontStyle = $saved[ 'style' ];
        $this->FontSizePt = $saved[ 'sizePt' ];
        $this->FontSize = $saved[ 'size' ];
        $this->CurrentFont =& $saved[ 'curr' ];

        if( $this->page > 0)
            $this->_out( sprintf( 'BT /F%d %.2f Tf ET', $this->CurrentFont[ 'i' ], $this->FontSizePt ) );

    }

    function newFlowingBlock( $w, $h, $b = 0, $a = 'J', $f = 0 )
    {

        // cell width in points
        $this->flowingBlockAttr[ 'width' ] = $w * $this->k;

        // line height in user units
        $this->flowingBlockAttr[ 'height' ] = $h;

        $this->flowingBlockAttr[ 'lineCount' ] = 0;

        $this->flowingBlockAttr[ 'border' ] = $b;
        $this->flowingBlockAttr[ 'align' ] = $a;
        $this->flowingBlockAttr[ 'fill' ] = $f;

        $this->flowingBlockAttr[ 'font' ] = array();
        $this->flowingBlockAttr[ 'content' ] = array();
        $this->flowingBlockAttr[ 'contentWidth' ] = 0;

    }

    function finishFlowingBlock()
    {

        $maxWidth =& $this->flowingBlockAttr[ 'width' ];

        $lineHeight =& $this->flowingBlockAttr[ 'height' ];

        $border =& $this->flowingBlockAttr[ 'border' ];
        $align =& $this->flowingBlockAttr[ 'align' ];
        $fill =& $this->flowingBlockAttr[ 'fill' ];

        $content =& $this->flowingBlockAttr[ 'content' ];
        $font =& $this->flowingBlockAttr[ 'font' ];

        // set normal spacing
        $this->_out( sprintf( '%.3f Tw', 0 ) );

        // print out each chunk

        // the amount of space taken up so far in user units
        $usedWidth = 0;

        foreach ( $content as $k => $chunk )
        {

            $b = '';

            if ( is_int( strpos( $border, 'B' ) ) )
                $b .= 'B';

            if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
                $b .= 'L';

            if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
                $b .= 'R';

            $this->restoreFont( $font[ $k ] );

            // if it's the last chunk of this line, move to the next line after
            if ( $k == count( $content ) - 1 )
                $this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
            else
                $this->Cell( $this->GetStringWidth( $chunk ), $lineHeight, $chunk, $b, 0, $align, $fill );

            $usedWidth += $this->GetStringWidth( $chunk );

        }

    }
    
    // Par�metros: Cadena original, Numero de columnas a imprimir la cadena, Variable del FPDF para imprimir devuelta 
function textIntoCols($strOriginal,$noCols,$pdf) 
{ 
    $iAlturaRow = 6; //Altura entre renglones 
    $iMaxCharRow = 550; //N�mero m�ximo de caracteres por rengl�n 
    $iSizeMultiCell = $iMaxCharRow / $noCols; //Tama�o ancho para la columna 
    $iTotalCharMax = 200000; //N�mero m�ximo de caracteres por p�gina 
    $iCharPerCol = $iTotalCharMax / $noCols; //Caracteres por Columna 
    $iCharPerCol = $iCharPerCol - 290; //Ajustamos el tama�o aproximado real del n�mero de caracteres por columna 
    $iLenghtStrOriginal = strlen($strOriginal); //Tama�o de la cadena original 
    $iPosStr = 0; // Variable de la posici�n para la extracci�n de la cadena. 
    // get current X and Y 
    $start_x = $pdf->GetX(); //Posici�n Actual eje X 
    $start_y = $pdf->GetY(); //Posici�n Actual eje Y 
    $cont = 0; 
    while($iLenghtStrOriginal > $iPosStr) // Mientras la posici�n sea menor al tama�o total de la cadena entonces imprime 
    { 
        $strCur = substr($strOriginal,$iPosStr,$iCharPerCol);//Obtener la cadena actual a pintar 
        if($cont != 0) //Evaluamos que no sea la primera columna 
        { 
            // seteamos a X y Y, siendo el nuevo valor para X 
            // el largo de la multicelda por el n�mero de la columna actual, 
            // m�s 10 que sumamos de separaci�n entre multiceldas 
            $pdf->SetXY(($iSizeMultiCell*$cont)+10,$start_y); //Calculamos donde iniciar� la siguiente columna 
        } 
        $pdf->MultiCell($iSizeMultiCell,$iAlturaRow,$strCur); //Pintamos la multicelda actual 
        $iPosStr = $iPosStr + $iCharPerCol; //Posicion actual de inicio para extracci�n de la cadena 
        $cont++; //Para el control de las columnas 
    }     
    return $pdf; 
}

}

$con = conectar();
$q1 = mysqli_query($con, "SELECT * FROM procedimiento WHERE id_procedimiento = '".$_GET['id_procedimiento']."'");

while($dato = mysqli_fetch_array($q1)){
    $id_procedimiento = $dato['id_procedimiento'];
    $fecha = $dato['fecha'];
    $hora = $dato['hora'];
    $descripcion = $dato['descripcion'];
}

 $Apriv = "

Procedimiento N�".$id_procedimiento."
                                                                                                                  Ciudad Bol�var, ".$fecha."
 
        En esta misma fecha, siendo las ".$hora." Se Registro un Procedimiento con la siguiente descripcion: ��".$descripcion."��
 

 FUNCIONARIO ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido'])."
 
 
"."                                                                                                                          Jefe del CCP 

                                                                                                                           FIRMA"."



                                                                                                                          _____________________";


utf8_encode($Apriv);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Ln(10);
$pdf->textIntoCols($Apriv,3,$pdf);
$pdf->Output();
?>
