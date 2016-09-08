<?php 
session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
require("../includes/conexion.php");
if(isset($_POST["id"])&& !empty($_POST['id'])){

$id = trim($_POST['id']);

$sqlver="DELETE FROM procedimiento WHERE id_procedimiento='$id'";

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