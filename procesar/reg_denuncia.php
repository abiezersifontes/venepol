<?php 
session_start();
if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']))
{

	require_once("../includes/conexion.php");
	$con = conectar();
	$id_funcionario = $_SESSION['id_funcionario'];
	
	$mensaje = null;

	if (isset($_POST["ajax"]))
	{
		$nac = $_POST['nac'];
		$cedula = $_POST['cedula'];
		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$edad = $_POST['edad'];
		$sexo = $_POST['sexo'];
		$telefono = $_POST['telefono'];
		$profesion = $_POST['profesion'];
		$estado_D1 = $_POST['estado_D'];
		$municipio_D1 = $_POST['municipio_D'];
		$parroquia_D1 = $_POST['parroquia_D'];
		$ciudad_D = $_POST['ciudad_D'];
		$calle_D = $_POST['calle_D'];
		$n_domicilio_D = $_POST['n_domicilio_D'];
		$fecha = $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];
		$hora = $_POST['hora'].":".$_POST['minu'].":00";
		$delito = $_POST['delito'];
		$relato_H = $_POST['relato_H'];
		$estado_H1 = $_POST['estado_H'];
		$municipio_H1 = $_POST['municipio_H'];
		$parroquia_H1 = $_POST['parroquia_H'];
		$ciudad_H = $_POST['ciudad_H'];
		$calle_H = $_POST['calle_H'];
		$cuadrante_H = $_POST['cuadrante_H'];
		$preguntas_y_respuestas = $_POST['preguntas_y_respuestas'];
		
		if ($nac == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($cedula == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($nombres == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($apellidos == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($edad == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($sexo == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($telefono == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}else if(!is_numeric($telefono))
		{
			echo $mensaje = "Debe Ingresar Numeros en el Campo Telefono";
		}
		else if ($profesion == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($estado_D1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($municipio_D1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($parroquia_D1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($ciudad_D == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($calle_D == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($n_domicilio_D == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($fecha == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($hora == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($delito == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($relato_H == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($estado_H1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($municipio_H1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($parroquia_H1 == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($ciudad_H == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($calle_H == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($cuadrante_H == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else
		{					
	
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
	
		//mysqli_character_set_name($con);
		//mysqli_set_charset($con, "utf8");

		mysqli_query($con ,"INSERT INTO denunciante (
		nac,
		cedula, 
		nombres, 
		apellidos, 
		edad,
		sexo, 
		telefono, 
		profesion, 
		estado, 
		municipio, 
		ciudad, 
		parroquia, 
		calle, 
		n_domicilio) VALUES (
		'".$nac."',
		'".$cedula."', 
		'".$nombres."', 
		'".$apellidos."', 
		'".$edad."',
		'".$sexo."', 
		'".$telefono."', 
		'".$profesion."', 
		'".$estado_D."', 
		'".$municipio_D."', 
		'".$ciudad_D."', 
		'".$parroquia_D."',
		'".$calle_D."',
		'".$n_domicilio_D."') 
		ON DUPLICATE KEY UPDATE 
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
		n_domicilio='".$n_domicilio_D."'");

		mysqli_query($con,"INSERT INTO denuncia (
		fecha, 
		hora,
		delitos, 
		relato, 
		estado, 
		municipio, 
		ciudad, 
		parroquia, 
		calle, 
		cuadrante, 
		preguntas_y_respuestas, 
		denunciante_cedula, 
		denuncia_id_funcionario)  VALUES ( 
		'".$fecha."', 
		'".$hora."',
		'".$delito."', 
		'".$relato_H."', 
		'".$estado_H."', 
		'".$municipio_H."', 
		'".$ciudad_H."', 
		'".$parroquia_H."', 
		'".$calle_H."', 
		'".$cuadrante_H."', 
		'".$preguntas_y_respuestas."', 
		'".$cedula."', 
		'".$id_funcionario."')");		

		if( mysqli_affected_rows($con) >= 1 ){
			$id_denuncia = mysqli_insert_id($con);
			?>
			<script language='Javascript'>
			alert('datos registrados correctamente');
			
			window.location="../consultas/acta_denuncia.php?id_denuncia=<?php echo $id_denuncia; ?>"; 
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
