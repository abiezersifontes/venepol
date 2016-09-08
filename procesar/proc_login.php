<?php
    session_start();
	require_once("../includes/conexion.php");
	ini_set('display_errors','off');
	ini_set('display_startup_errors','off');
	error_reporting(0);
	

	if($_SESSION['texto'] == $_POST['captcha']){
		if(isset($_POST['NOMBRE_F']) && !empty($_POST['NOMBRE_F']) && isset($_POST['PW']) && !empty($_POST['PW']))
		{
		$con = conectar();
		
		$sql=" SELECT * FROM funcionario WHERE usuario = '$_POST[NOMBRE_F]' AND pw ='".md5($_POST[PW])."'"; //código MySQL
		
		$q = mysqli_query($con,$sql); //enviar código MySQL
		
		while ($row = mysqli_fetch_array($q)) { //Bucle para ver todos los registros
		  	$_SESSION["id_funcionario"] = $row['id_Funcionario'];
			$_SESSION["nombre"] = $row['nombre_f'];
			$_SESSION["apellido"] = $row['apellido_f'];
			$_SESSION["password"] = $row['pw'];
			$_SESSION['tipo'] = $row['tipo'];
			$_SESSION['ccp'] = $row['ccp'];
		  }
			try{
				if(mysqli_field_seek($q,0))
				{
					if($_SESSION['tipo']=="administrador")
					{
						echo "<script language='Javascript'>
						alert('Bienvenido ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido'])."');
						document.location=('../procesar/iniciar.php');
						</script>";
					}
					else
					{
							echo "<script language='Javascript'>
							alert('Bienvenido ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido'])."');
							document.location=('../procesar/iniciar.php');
							</script>";
					}						
				}
				else
				{
					echo "<script language='Javascript'>
					alert('Usuario y/o Contraseña Erronea');
					document.location=('../index.php');
					</script>";
					
				}	
			}catch(Exception $error){}
			mysqli_close($con);
		}
		else{
			echo "<script language='javascript'>
				alert('Debe Llenar Todos los Campos');
				document.location=('../index.php');
			</script>";
		}
	}else{
		?>
		<script type="text/javascript">
			alert('Debe ingresar los datos de la imagen de manera correcta');
			window.location='../index.php';
		</script>
		<?php
	}
	?>