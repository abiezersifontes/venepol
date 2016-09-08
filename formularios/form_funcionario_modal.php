<?php session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']))
{
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Funcionarios</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="../css/estilos.css">
<script type="text/javascript" src="../includes/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		 $(".btn").on("click", function(){
			 
			 $.ajax({
				   type: "POST",
				   url: '../procesar/mod_funcionario.php',
				   data: $("#form").serialize(), // Adjuntar los campos del formulario enviado.
				   success: function(data)
				   {
					   $("#validacion").html(data); // Mostrar la respuestas del script PHP.
				   }
				 });	
			return false; // Evitar ejecutar el submit del formulario.
		 });
    });
</script>
</head>
<body>
<div class="container">
	
	<div id="inicio">
				<div id="banner"><img src="../recursos/LOGO-VENEPOL.png" id="img_banner"></div>
				
				<div id="usuario">
					<table id="panel">
							<tr>
								<td align="left" id="panel1">
									<?php
										echo ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido']); 
									?>
								</td>
								<td id="panel">
									<a href="../procesar/iniciar.php">Menu Principal</a>
								</td>
								<td id="panel">
									<a href="../procesar/cerrar_session.php">Cerrar Sesion</a>
								</td>
							</tr>
							<tr>
								<td align="left">
									<?php
										echo "CCP: ".ucwords($_SESSION['ccp']); 
									?>
								</td>
							</tr>
					  </table>
				</div>
		<table id="division2">
			<tr>
				<td>
					<h1>Registro de Funcionarios </h1>
				</td>
			</tr>
			<tr>
				<td>
					<div id="validacion">

					</div>
				</td>
			</tr>
			<tr>
				<td>
				<?php
					require_once('../includes/conexion.php');
					$con = conectar();
					$id_funcionario = $_GET['id_funcionario'];
					$sql = "SELECT * FROM funcionario WHERE id_Funcionario='".$id_funcionario."'";


					$consulta = mysqli_query($con, $sql);

					if(mysqli_num_rows($consulta)){

						while($dato=mysqli_fetch_array($consulta)){
							$cod_funcionario = $dato['cod_funcionario'];
							$cedula_fun = $dato['cedula_f'];
							$nombre_fun = $dato['nombre_f'];
							$apellido_fun = $dato['apellido_f'];
							$ccp_fun = $dato['ccp'];
							$cargo_fun = $dato['cargo'];
							$rango_fun = $dato['rango'];
							$tipo_fun = $dato['tipo'];
							$usuario_fun = $dato['usuario'];
							$clave_fun = $dato['pw'];

						}

					}else{
						echo "no se pudo realizar una consulta para el id: ".$id_funcionario;
					}

				?>	
					<div class="formulario">
					<h2>Datos</h2>
					<br/>
					<form id="form">
						<label>Cod Funcionario<span id="red">(*)</span></label>
						<br/>
						<input name="cod_funcionario" value="<?php echo $cod_funcionario; ?>" id="cod_funcionario" type="text">
						<br/>
						<label>Cedula<span id="red">(*)</span></label>
						<br/>
						<input name="cedula_fun" value="<?php echo $cedula_fun; ?>" id="cedula_fun" type="text">
						<br/>
						<label>Nombre<span id="red">(*)</span></label>
						<br/>
						<input name="nombre_fun" value="<?php echo $nombre_fun; ?>" id="nombre" type="text">
						<br/>
						<label>Apellido<span id="red">(*)</span></label>
						<br/>
						<input name="apellido_fun" value="<?php echo $apellido_fun; ?>" id="apellido" type="text">
						<br/>
						<label>CCP<span id="red">(*)</span></label>
						<br/>
						<input name="ccp_fun" value="<?php echo $ccp_fun; ?>" id="ccp" type="text">
						<br/>
						<label>Cargo<span id="red">(*)</span></label>
						<br/>
						<input name="cargo" value="<?php echo $cargo_fun; ?>" id="cargo" type="text">
						<br/>
						<label>Rango<span id="red">(*)</span></label>
						<br/>
						<input name="rango" value="<?php echo $rango_fun; ?>" id="rango" type="text">
						<br/>
						<label>Tipo<span id="red">(*)</span></label>
						<br/>
						<select name="tipo_fun" id="tipo">
						<?php 
						if($tipo_fun == "administrador"){
						?>
							<option value="administrador" selected="selected">Administrador</option>
							<option value="usuario">Funcionario</option>
						<?php } 
						else{
						?><option value="administrador" selected="selected">Administrador</option>
							<option value="usuario">Funcionario</option><?php
						}
						?>
						</select>
						<br/>
						<label>Usuario<span id="red">(*)</span></label>
						<br/>
						<input name="usuario" value="<?php echo $usuario_fun; ?>" id="usuario" type="text">
						<br/>
						<label>Clave<span id="red">(*)</span></label>
						<br/>
						<input name="pw" value="<?php echo $clave_fun; ?>" id="pw" type="text"><br/><br/>
						<input type="hidden" name="ajax" id="ajax">
						<input type="hidden" value="<?php echo $id_funcionario; ?>" name="id_funcionario_mod" id="id_funcionario_mod">

						<input class="btn" type="submit" value="Guardar"/>
					</form>
				</td>
			</tr>
		</div>
	</table>
</div>
</body>
</html>
<?php 
}else{
	?><script language='Javascript'>
				document.location=('../index.php');
	</script>
<?php 
	}
?>