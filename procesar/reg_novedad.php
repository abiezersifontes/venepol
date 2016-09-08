<?php 
session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
	
	include("../includes/conexion.php");
	$mensaje = null;

	if (isset($_POST["ajax"]))
	{
		$fecha = utf8_encode($_POST['ano']."-".$_POST['mes']."-".$_POST['dia']);
		$hora = utf8_encode($_POST['hora'].":".$_POST['minu']);
		$funcionario = $_SESSION['id_funcionario'];
		$descripcion = utf8_encode($_POST["descripcion"]);
		
		if ($fecha == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else if ($hora == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}	
		else if ($descripcion == '')
		{
			echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'></span>";
		}
		else
		{					
			$con = conectar();
			
			$sql = "INSERT INTO 
			novedad 
			(fecha, 
			hora, 
			descripcion, 
			novedad_id_funcionario) 
			VALUES(
			'".$fecha."', 
			'".$hora."', 
			'".$descripcion."', 
			'".$funcionario."')";
		
			mysqli_query($con, $sql);
			
			if( mysqli_affected_rows($con) >= 1 ){
				?><script language='Javascript'>
				alert("Datos Registrados Exitosamente");
				document.location=('../formularios/form_novedad.php');
				</script><?php
			}
			else{
		 		echo $mensaje = "No se pudieron guardar los datos. " . mysqli_error() . ". " . mysqli_errno();
			}
		}
	}
}else{
	?><script language='Javascript'>
			document.location=('../index.php');
	</script><?php
			} 
	?>