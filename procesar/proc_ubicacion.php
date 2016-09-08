<?php
include("../includes/conexion.php");
$con = conectar();
$ubicacion = $_POST['ubicacion'];
$tabla = $_POST['tabla'];

if($tabla=="municipio"){
	$query="SELECT * FROM municipio WHERE estado_id='$ubicacion'";
}else if($tabla=="parroquia"){
	$query="SELECT * FROM parroquia WHERE municipio_id='$ubicacion'";
}

$consulta=mysqli_query($con,$query);

while($row=mysqli_fetch_array($consulta)){
	echo "<option value=\"".$row['id']."\">".utf8_encode($row['nombre'])."</option>"; 
}

?> 