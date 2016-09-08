<?php 
session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
session_destroy();
echo "<script>
window.location='../index.php';
</script>";
}else{
	echo 	"<script language='Javascript'>
				document.location=('../index.php');
			</script>";
			} 
	?>