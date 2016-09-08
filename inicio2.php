<?php session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
		if($_SESSION['tipo']=="administrador"){
		 ?><!DOCTYPE HTML>
		<html>
			<head>
			<title> Venepol </title>
			<link rel="stylesheet" type="text/css" href="css/menu.css"/>
			
			</head>
			<body>
				<div id="inicio">
					
					<div id="banner">
						<img src="recursos/venepol.png" id="img_banner">
					</div>
					
					<div id="usuario">
					<table id="panel">
								<tr>
									<td id="panel1">
										<?php
											echo "Bienvenido:".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido']); 
										?>
									</td>
									<td id="panel">
										<a href="procesar/iniciar.php">Menu Principal</a>
									</td>
									<td id="panel">
										<a href="procesar/cerrar_session.php">Cerrar Sesion</a>
									</td>
								</tr>
						  </table>
					</div>
					<div id="menu">
						<table id="menu">
							<tr>
								<td id="menu"><a href="consultas/consulta_denuncia.php"><img src="recursos/denuncia.png"><br><h2>Denuncia<h2></a></td>
								<td id="menu"><a href="consultas/consulta_procedimiento.php"><img src="recursos/procedimiento.png"><br><h2>Procedimiento<h2></a></td>
								<td id="menu"><a href="consultas/consulta_novedad.php"><img src="recursos/novedad.png"><br><h2>Novedad<h2></a></td>
								<td id="menu"><a href="consultas/consulta_funcionario.php"><img src="recursos/funcionario.png"><br><h2>Funcionario<h2></a></td>
							</tr>
						</table>
						<table id="opciones">
							<tr>
								<td>
									<a href="procesar/respaldodebase.php"><img src="recursos/respaldo.jpg" id="boton"></a>
								</td>
								<td>
									<a href="recursos/manual_administrador.pdf"><img src="recursos/ayuda.png" id="boton"></a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</body>
		</html>
		<?php 
		}else{
			?>
			<script type="text/javascript">
				window.location='inicio.php';
			</script>
			<?php
		}
	}else{
	echo 	"<script language='Javascript'>
				document.location=('index.php');
			</script>";
			}
	?>
