<?php

class Conexion{

private static $host;
private static $user;
private static $clave;
private static $bd;
private $cone;
private $sql;
private $consulta;
private $actualiza;
private $elimina;
private $agrega;
private  $extrae;

function __construct(){
self::$host="localhost";
self::$user="root";
self::$clave="";
self::$bd="venepol";
$this->cone=null;
$this->sql=null;
$this->consulta=null;
$this->actualiza=null;
$this->elimina=null;
$this->extrae=null;
}
function __destruct(){

}

function conectar(){
$this->cone = new mysqli(self::$host,self::$user,self::$clave,self::$bd);
if(mysqli_connect_errno()){
echo "errror al conectar server";
exit();
}
return $this->cone;
}

function agregar($sql){
if($this->agrega = $this->cone->query($sql)){
echo "<h3>datos agregados con exito</h3>";
}else{
echo "<h3>error al agregar datos</h3>";
exit();
}
}

function extraer($sql){
if($this->extrae = $this->cone->query($sql)){
if($this->extrae){
return $this->extrae;
}else{
echo "<h3>error al extraer datos</h3>";
exit();
}
}
}

function consultar($sql){
if($this->consulta = $this->cone->query($sql)){
if(mysqli_num_rows($this->consulta)==1){
return $this->consulta;
$this->consulta->close();
}
}else{
echo "<h3>error en consulta</h3>";
exit();
} 
}

function actualizar($sql){
if($this->actualiza = $this->cone->query($sql)){
echo "<h3>datos actualizado con exito</h3>";
}else{
echo "<h3>error al actualizar</h3>";
}
}

function eliminar($sql){
$this->elimina = $this->cone->query($sql);
if($this->elimina){
echo "<h3>datos eliminado con exito</h3>";
}else{
echo "<h3>error al eliminar datos</h3>";
}
}

function actualizar2($sql){
$this->cone->query($sql);
}

function agregar2($sql){
$this->cone->query($sql);
}
function eliminar2($sql){
$this->cone->query($sql);
}

function respaldo(){


$nombre_backup = date("Y-m-d")."-clpp.sql";
 
// CABECERAS PARA DESCARGAR EL ARCHIVO
header("Content-type: application/savingfile");
header("Content-Disposition: attachment; filename=$nombre_backup");
header("Content-Description: Document.");



      $result = $this->cone->query('SHOW TABLES');
     
 
// RECORRO TODAS LAS TABLAS
while ($tabla = $result->fetch_row()) {
 
    // RECUPERO LA INFORMACION DE CREACION DE LA TABLA
    $creacion = $this->cone->query("SHOW CREATE TABLE $tabla[0]");
    $creaccion = $creacion->fetch_array();
    echo "-- Informacion de creacion de la tabla $tabla[0]\n\n";
    echo $creaccion['Create Table']."\n\n";
 
    // VUELCO LOS REGISTROS DE LA TABLA
    echo "-- Volcado de registros en la tabla $tabla[0]\n\n";
 
    // RECUPERO LOS NOMBRES DE LOS CAMPOS
    $columnas_txt = "";
    $columnas = $this->cone->query("SHOW COLUMNS FROM $tabla[0]");
    $cantidad_columnas = $columnas->num_rows;
    if ($columnas->num_rows > 0) {
        while ($columna = $columnas->fetch_array()) {
            $columnas_txt .= $columna['Field'] . ", ";

        }
    }
    $columnas = substr($columnas_txt, 0, -2);
    $a = split(",",$columnas); 
    $cool= "INSERT INTO '$tabla[0]' (";
    for($i=0;$i<count($a);$i++){
    if($i+1<count($a)){
    $cool.="'$a[$i]',";
    }else{
    $cool.="'$a[$i]'";
    }
    }
    $cool.=") VALUES\n";
    echo $cool;
 
    $registros_txt = "";
    $registros = $this->cone->query("SELECT * FROM $tabla[0]");
    while ($registro = $registros->fetch_array()) {
        $i = 0;
        $registro_txt = "";
        while ($i < $cantidad_columnas) {
            $registro_txt .= "'$registro[$i]', ";
            $i++;
        }
        $registros_txt .= "(".substr($registro_txt, 0, -2)."),\n";
    }
    echo substr($registros_txt, 0, -2).";\n\n\n";
}


}



function cerrar(){
$this->cone->close();
}

}

?>
