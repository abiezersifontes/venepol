<?php 
error_reporting(1);
session_start();
if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']))
{

	require_once("../includes/conexion.php");
	$con = conectar();
	$id_funcionario = $_SESSION['id_funcionario'];
	
	$mensaje = null;

	if (isset($_POST["ajax"]))
	{
		$nac = utf8_encode($_POST['nac']);
		$cedula = utf8_encode($_POST['cedula']);
		$nombres = utf8_encode($_POST['nombres']);
		$apellidos = utf8_encode($_POST['apellidos']);
		$edad = utf8_encode($_POST['edad']);
		$sexo = utf8_encode($_POST['sexo']);
		$telefono = utf8_encode($_POST['telefono']);
		$profesion = utf8_encode($_POST['profesion']);
		$estado_D1 = utf8_encode($_POST['estado_D']);
		$municipio_D1 = utf8_encode($_POST['municipio_D']);
		$parroquia_D1 = utf8_encode($_POST['parroquia_D']);
		$ciudad_D = utf8_encode($_POST['ciudad_D']);
		$calle_D = utf8_encode($_POST['calle_D']);
		$n_domicilio_D = utf8_encode($_POST['n_domicilio_D']);
		$fecha = utf8_encode($_POST['ano']."-".$_POST['mes']."-".$_POST['dia']);
		$hora = utf8_encode($_POST['hora'].":".$_POST['minu'].":00");
		$delito = utf8_encode($_POST['delito']);
		$relato_H = utf8_encode($_POST['relato_H']);
		$estado_H1 = utf8_encode($_POST['estado_H']);
		$municipio_H1 = utf8_encode($_POST['municipio_H']);
		$parroquia_H1 = utf8_encode($_POST['parroquia_H']);
		$ciudad_H = utf8_encode($_POST['ciudad_H']);
		$calle_H = utf8_encode($_POST['calle_H']);
		$cuadrante_H = utf8_encode($_POST['cuadrante_H']);
		$preguntas_y_respuestas = utf8_encode($_POST['preguntas_y_respuestas']);
		$id_denunciante_mod = $_POST['id_denunciante_mod'];
		$id_denuncia_mod = $_POST['id_denuncia_mod'];
		
		if ($nac == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($cedula == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($nombres == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($apellidos == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($edad == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($sexo == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($telefono == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($profesion == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($estado_D1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($municipio_D1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($parroquia_D1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($ciudad_D == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($calle_D == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($n_domicilio_D == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($fecha == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($hora == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($delito == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($relato_H == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($estado_H1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($municipio_H1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($parroquia_H1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($ciudad_H == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else if ($calle_H == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}	
		else if ($cuadrante_H == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos";
		}
		else
		{					
		
		//mysqli_character_set_name($con);
		//mysqli_set_charset($con, "utf8");

		if(strlen($estado_D1)<=2){
			$query_estado_D = "SELECT nombre FROM estado WHERE id='".$estado_D1."'";
			$consulta_estado_D = mysqli_query($con, $query_estado_D);
			while($row=mysqli_fetch_array($consulta_estado_D)){
				$estado_D = $row['nombre'];
			}
		}else{
			$estado_D = $estado_D1;
		}

		if(strlen($municipio_D1)<=3){
			$query_municipio_D = "SELECT nombre FROM municipio WHERE id='".$municipio_D1."'";
			$consulta_municipio_D = mysqli_query($con, $query_municipio_D);
			while($row=mysqli_fetch_array($consulta_municipio_D)){
				$municipio_D = $row['nombre'];
			}
		}else{
			$municipio_D = $municipio_D1;
		}

		if(strlen($parroquia_D1)<=4){
			$query_parroquia_D = "SELECT nombre FROM parroquia WHERE id='".$parroquia_D1."'";
			$consulta_parroquia_D = mysqli_query($con, $query_parroquia_D);
			while($row=mysqli_fetch_array($consulta_parroquia_D)){
				$parroquia_D = $row['nombre'];
			}
		}else{
			$parroquia_D = $parroquia_D1;
		}

		if(strlen($estado_H1)<=2){
			$query_estado_H = "SELECT nombre FROM estado WHERE id='".$estado_H1."'";
			$consulta_estado_H = mysqli_query($con, $query_estado_H);
			while($row=mysqli_fetch_array($consulta_estado_H)){
				$estado_H = $row['nombre'];
			}
		}else{
			$estado_H = $estado_H1;
		}

		if(strlen($municipio_H1)<=3){
			$query_municipio_H = "SELECT nombre FROM municipio WHERE id='".$municipio_H1."'";
			$consulta_municipio_H = mysqli_query($con, $query_municipio_H);
			while($row=mysqli_fetch_array($consulta_municipio_H)){
				$municipio_H = $row['nombre'];
			}
		}else{
			$municipio_H = $municipio_H1;
		}

		if(strlen($parroquia_H1)<=4){
			$query_parroquia_H = "SELECT nombre FROM parroquia WHERE id='".$parroquia_H1."'";
			$consulta_parroquia_H = mysqli_query($con, $query_parroquia_H);
			while($row=mysqli_fetch_array($consulta_parroquia_H)){
				$parroquia_H = $row['nombre'];
			}
		}else{
			$parroquia_H = $parroquia_H1;
		}

		/*echo $nac-"-".$cedula.", ".$nombres.", ".$apellidos.", ".$edad.", ".$sexo.", ".$telefono.", ".$estado_D.", ".$municipio_D
		.", ".$ciudad_D.", ".$parroquia_D.", ".$calle_D.", ".$n_domicilio_D.", ".$fecha.", ".$hora.", ".$delito.", ".$relato_H.", ".$estado_H.", ".
		$municipio_H.", ".$ciudad_H.", ".$parroquia_H.", ".$calle_H.", ".$cuadrante_H.", ".$preguntas_y_respuestas.", ".$cedula.", ".$id_funcionario;
		exit();*/

		$sql1="UPDATE denunciante SET 
		nac='".$nac."',
		cedula='".$cedula."', 
		nombres='".$nombres."', 
		apellidos='".$apellidos."', 
		edad='".$edad."',
		sexo='".$sexo."', 
		telefono='".$telefono."', 
		profesion='".$profesion."', 
		estado='".$estado_D."', 
		municipio='".$municipio_D."', 
		ciudad='".$ciudad_D."', 
		parroquia='".$parroquia_D."', 
		calle='".$calle_D."', 
		n_domicilio='".$n_domicilio_D."' WHERE cedula='".$id_denunciante_mod."'";
		

		mysql_query($con, $sql1);

		$sql2 = "UPDATE denuncia SET 
		fecha='".$fecha."', 
		hora='".$hora."',
		delitos='".$delito."', 
		relato='".$relato_H."', 
		estado='".$estado_H."', 
		municipio='".$municipio_H."', 
		ciudad='".$ciudad_H."', 
		parroquia='".$parroquia_H."', 
		calle='".$calle_H."', 
		cuadrante='".$cuadrante_H."', 
		preguntas_y_respuestas='".$preguntas_y_respuestas."', 
		denunciante_cedula='".$cedula."', 
		denuncia_id_funcionario='".$id_funcionario."' WHERE id_denuncia='".$id_denuncia_mod."'";

		mysqli_query($con, $sql2);		

		if( mysqli_affected_rows($con) >= 1 ){
			?>
			<script language='Javascript'>
			alert('Datos modificados correctamente');
			
			window.location="../consultas/acta_denuncia.php?id_denuncia=<?php echo $id_denuncia_mod; ?>"; 
			</script>
			<?php
			}
		else{
			echo "No se pudieron guardar los datos. " . mysqli_error() . ". " . mysqli_errno();
			}
		}
	}
}
else{
	?><script language='Javascript'>
		document.location=('../index.php');
	</script><?php
} 
	?>