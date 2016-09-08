<?php 
session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
if($_SESSION['tipo'] == "administrador"){
	echo "<script>
	window.location='../inicio2.php';
	</script>";
}
else{
	echo "<script>
	window.location='../inicio.php';
	</script>";

}
}else{
	echo 	"<script language='Javascript'>
				document.location=('../index.php');
			</script>";
			} 
	?>