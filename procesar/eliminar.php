<?php 
error_reporting(1);
session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
		
		require_once("../includes/conexion.php");
		
		if(isset($_POST["id"])&& !empty($_POST['id']) && isset($_POST['tabla']) && !empty($_POST['tabla'])) {

		$id = trim($_POST['id']);
		$tabla = trim($_POST['tabla']);

		if($tabla!="funcionario"){
			$sqlver = "DELETE FROM ".$tabla." WHERE id_".$tabla."='$id'";
		}else{
			$sqlver = "DELETE FROM ".$tabla." WHERE id_Funcionario='$id'";
		}

		$con = conectar();
		$ver = mysqli_query($con,$sqlver);
		
		if($ver==1){
		echo "si";
		}else{
		echo "no";
		}
}else{
	echo"no";
}
}else{
	?><script language='Javascript'>
				document.location=('../index.php');
			</script><?php
	}
	?>
