<?php
	session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){

		require_once("../includes/conexion.php");
		$con = conectar();
		$mensaje = null;

		if (isset($_POST["ajax"]))
		{
			$cod_funcionario = $_POST['cod_funcionario'];
			$cedula_fun = $_POST['cedula_fun'];
			$nombre_fun = $_POST['nombre_fun'];
			$apellido_fun = $_POST['apellido_fun'];
			$ccp_fun = $_POST['ccp_fun'];
			$cargo_fun = $_POST['cargo'];
			$rango_fun = $_POST['rango'];
			$tipo_fun = $_POST['tipo_fun'];
			$usuario_fun = $_POST['usuario'];
			$pw_fun = md5($_POST['pw']);

			if ($cod_funcionario == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'>(*)</span>";
			}
			else if ($cedula_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'>(*)</span>";
			}	
			else if ($nombre_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'>(*)</span>";
			}
			else if ($apellido_fun == '') {
				echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'>(*)</span>";
			}
			else if ($ccp_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'>(*)</span>";
			}	
			else if ($cargo_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'>(*)</span>";
			}
			else if ($rango_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'>(*)</span>";
			}
			else if ($tipo_fun == '') {
				echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'>(*)</span>";
			}
			else if ($usuario_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'>(*)</span>";
			}	
			else if ($pw_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos<span id='red'>(*)</span>";
			}
			else{

				

				$sql = "INSERT INTO funcionario (cod_funcionario, cedula_f, nombre_f, apellido_f, ccp, cargo, rango, tipo, usuario, pw) VALUES(
				'".$cod_funcionario."', '".$cedula_fun."', '".$nombre_fun."', '".$apellido_fun."', '".$ccp_fun."', '".$cargo_fun."', '".$rango_fun."', '".$tipo_fun."', '".$usuario_fun."', '".$pw_fun."')";
				

				$consulta = mysqli_query($con, $sql);
				
				if( mysqli_affected_rows($con) >= 1 ){
				?><script language='Javascript'> 
				alert('datos registrados correctamente');
				document.location=('../procesar/iniciar.php'); 
				</script><?php
				}else{
			 		echo "Debe Realizar Algun Cambio";//"No se pudieron guardar los datos: " . mysqli_error($con) . ", " . mysqli_errno($con);
				}
			}
		}else{
			echo "no pasa la variable ajax";
		}
	}else{
	?><script language='Javascript'>
		document.location=('../index.php');
	</script><?php
		}
	?>