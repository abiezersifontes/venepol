<?php 
	session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
		
		include("../includes/conexion.php");
						
		if (isset($_POST["ajax"]))
	{
		$fecha = utf8_encode($_POST['ano']."-".$_POST['mes']."-".$_POST['dia']);
		$hora = utf8_encode($_POST['hora'].":".$_POST['minu']);
		$funcionario = $_SESSION['id_funcionario'];
		$descripcion = utf8_encode($_POST["descripcion"]);
		$id_procedimiento = utf8_encode($_POST["id_procedimiento"]);

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
		else{

		$con = conectar();

				$sql = "UPDATE procedimiento SET fecha='".$fecha."', hora ='".$hora."', descripcion='".$descripcion."', procedimiento_id_funcionario = '".$funcionario."' WHERE id_procedimiento='".$id_procedimiento."'";
			
				$resultado = mysqli_query($con,$sql);
				
				if( mysqli_affected_rows($con) >= 1 ){
					?><script language='Javascript'>
					alert("Datos Modificados Exitosamente");
					document.location=('../consultas/consulta_procedimiento.php');
					</script><?php
				}else{
			 		echo $mensaje = "debe realizar algun cambio";//"No se pudieron guardar los datos. " . mysqli_error($con) . ". " . mysqli_errno($con);
				}
		}
	}

	}else{
		?><script language='Javascript'>
				document.location=('../index.php');
		</script>
		<?php
		} 
?>