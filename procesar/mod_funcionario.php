<?php

	session_start();

	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){

		require_once("../includes/conexion.php");
		$con = conectar();
		$mensaje = null;




		if (isset($_POST["ajax"]))
		{


			
			$id_funcionario_mod = $_POST['id_funcionario_mod'];

			$cod_funcionario = $_POST['cod_funcionario'];

			$cedula_fun = $_POST['cedula_fun'];

			$nombre_fun = $_POST['nombre_fun'];

			$apellido_fun = $_POST['apellido_fun'];

			$ccp_fun = $_POST['ccp_fun'];

			$cargo_fun = $_POST['cargo'];

			$rango_fun = $_POST['rango'];

			$tipo_fun = $_POST['tipo_fun'];

			$usuario_fun = $_POST['usuario'];

				
			if(strlen($_POST['pw'])>=15){
				$pw = $_POST['pw'];
			}else{
				$pw = md5($_POST['pw']);
			}

			//echo $id_funcionario_mod.", ".$cod_funcionario.", ".$cedula_fun.", ".$nombre_fun.", ".$apellido_fun.", ".$ccp_fun.", ".$cargo_fun.", ".$rango_fun.", ".$tipo_fun.", ".$usuario_fun.", ".$pw;
			//exit();

			if ($cod_funcionario == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos";
			}
			else if ($cedula_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos";
			}	
			else if ($nombre_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos";
			}
			else if ($apellido_fun == '') {
				echo $mensaje = "Debe Ingresar Todos los Campos";
			}
			else if ($ccp_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos";
			}	
			else if ($cargo_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos";
			}
			else if ($rango_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos";
			}
			else if ($tipo_fun == '') {
				echo $mensaje = "Debe Ingresar Todos los Campos";
			}
			else if ($usuario_fun == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos";
			}	
			else if ($pw == ''){
				echo $mensaje = "Debe Ingresar Todos los Campos";
			}
			else{

				
				$sql = "UPDATE funcionario SET 
				cod_funcionario='".$cod_funcionario."', 
				cedula_f='".$cedula_fun."', 
				nombre_f='".$nombre_fun."', 
				apellido_f='".$apellido_fun."', 
				ccp='".$ccp_fun."', 
				cargo='".$cargo_fun."', 
				rango='".$rango_fun."', 
				tipo='".$tipo_fun."', 
				usuario='".$usuario_fun."',
				pw='".$pw."' 
				WHERE id_Funcionario='".$id_funcionario_mod."'";


				$consulta = mysqli_query($con, $sql);



				if( mysqli_affected_rows($con) >= 1 ){

				?><script language='Javascript'> 
				alert('datos registrados correctamente');
				document.location=('../consultas/consulta_funcionario.php'); 
				</script><?php
				}else{
			 		echo "debe realizar algun cambio ";//"No se pudieron guardar los datos: ".mysqli_error($con).", ".mysqli_errno($con);
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