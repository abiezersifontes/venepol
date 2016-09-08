<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>login</title>
		<link rel= "stylesheet" type = "text/css" href="css/login.css"/>
	</head>
	<body>
		<div id="index">
			<div id="banner">
			<img src="recursos/venepol.png" id="img_banner">
			</div>
		<div id="caja">
				<h2>Ingresar Al Sistema</h2>
    			<form action="procesar/proc_login.php" method = "POST">
				<input type = "text" name = "NOMBRE_F" / placeholder="Nombre" id="nombre"><br>
    				<input type="password" name = "PW"/ placeholder="Clave" id="clave"><br><br>
    				<img src="procesar/capchapt.php"><br><br>
    				<input type="text" name="captcha" placeholder="Introduzca el codigo de la imagen" id="nombre"><br><br>
					<input type="submit" name="boton" value="Entrar" id="Enviar"/>
    				<input type="reset" name="limpiar" value="Limpiar" id="Limpiar">
				</form>
    		</div>
		</div>
	</body>
</html>
