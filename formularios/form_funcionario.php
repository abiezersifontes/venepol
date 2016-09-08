<?php 
session_start();
if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']))
{
		$_SESSION['nombre'] = $_SESSION['nombre'];
		$_SESSION['apellido'] = $_SESSION['apellido'];
		$_SESSION['tipo'] = $_SESSION['tipo'];
?>
<!DOCTYPE html>
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
				   url: '../procesar/reg_funcionario.php',
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
					<div class="formulario">
					<h2>Datos</h2>
					<br/>
					<form id="form">
						<label>Cod Funcionario<span id="red">(*)</span></label>
						<br/>
						<input name="cod_funcionario" id="cod_funcionario" type="text">
						<br/>
						<label>Cedula<span id="red">(*)</span></label>
						<br/>
						<input name="cedula_fun" id="cedula_fun" type="text">
						<br/>
						<label>Nombre<span id="red">(*)</span></label>
						<br/>
						<input name="nombre_fun" id="nombre" type="text">
						<br/>
						<label>Apellido<span id="red">(*)</span></label>
						<br/>
						<input name="apellido_fun" id="apellido" type="text">
						<br/>
						<label>CCP<span id="red">(*)</span></label>
						<br/>
						<input name="ccp_fun" id="ccp" type="text">
						<br/>
						<label>Cargo<span id="red">(*)</span></label>
						<br/>
						<input name="cargo" id="cargo" type="text">
						<br/>
						<label>Rango<span id="red">(*)</span></label>
						<br/>
						<input name="rango" id="rango" type="text">
						<br/>
						<label>Tipo<span id="red">(*)</span></label>
						<br/>
						<select name="tipo_fun" id="tipo">
							<option value="administrador">Administrador</option>
							<option value="usuario">Funcionario</option>
						</select>
						<br/>
						<label>Usuario<span id="red">(*)</span></label>
						<br/>
						<input name="usuario" id="usuario" type="text">
						<br/>
						<label>Clave<span id="red">(*)</span></label>
						<br/>
						<input name="pw" id="pw" type="password"><br/><br/>
						<input type="hidden" name="ajax" id="ajax">
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