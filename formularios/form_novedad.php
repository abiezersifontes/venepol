<?php session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
 ?>
<!DOCTYPE html>
<html>
<head>

<title>Novedades</title>

<link rel="stylesheet" type="text/css" href="../css/estilos.css">
<script type="text/javascript" src="../includes/jquery.js"></script>
<script type="text/javascript">
	$(function()
    {
		 $(".btn").click(function(){
			 $.ajax({
				   type: "POST",
				   url: '../procesar/reg_novedad.php',
				   data: $("#form").serialize(), // Adjuntar los campos del formulario enviado.
				   success: function(data)
				   {
					   $("#validacion").html(data); // Mostrar la respuestas del script PHP.
				   }
				 });	
			return false; // Evitar ejecutar el submit del formulario. */
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
			</div>
			<table id="division2">
				<tr>
					<td>
						<h1>Registro de Novedades</h1>
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
							<table id="division">
								<tr id="division">
							<td id="division">
							<form action="" method="post" id="form">
										<h4>Fecha:<span id="red">(*)</span><h4>
									</td>
									<td id="division">
										<select name="dia">
											<?php for($i=01;$i<=31;$i++){
												?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php
											} ?>
										</select>
										<select name="mes">
											<option value="01">Enero</option>
											<option value="02">Febrero</option>
											<option value="03">Marzo</option>
											<option value="04">Abril</option>
											<option value="05">Mayo</option>
											<option value="06">Junio</option>
											<option value="07">Julio</option>
											<option value="08">Agosto</option>
											<option value="09">Septiembre</option>
											<option value="10">Octubre</option>
											<option value="11">Noviembre</option>
											<option value="11">Diciembre</option>
										</select>
										<select name="ano">
											<option value="2015">2015</option>
											<option value="2014">2014</option>
											<option value="2013">2013</option>
											<option value="2012">2012</option>
											<option value="2011">2011</option>
											<option value="2010">2010</option>
										</select>
										</br>
									</td>
								</tr>
								<tr id="division">
									<td id="division">
										<h4>Hora (24h):<span id="red">(*)</span><h4>
									</td>
									<td id="division">
										<select name="hora">
											<?php for($i=0;$i<=23;$i++){
												?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php
											} ?>
										</select>
										:
										<select name="minu" id="minu">
										<?php for($i=00;$i<60;$i++){
												if($i<10){
													$e = 0;
												}else{
													$e = "";
												}
											?><option value="<?php echo $i; ?>"><?php echo $e."".$i; ?></option><?php

										} ?>
									</select>
									</td>
								</tr>
								<tr id="division">
									<td id="division">
									
										<h4>Descripcion:<span id="red">(*)</span><h4>
									
									</td>
									<td id="division">
										<textarea name="descripcion" id="descripcion"></textarea><br/><br/>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td>
					    <input type="hidden" name="ajax">
						<input class="btn" type="submit" value="Guardar"/> 
						</form>
					</td>
				</tr>
			</table>
		</div>
</body>
</html>&#65279;
<?php }else{
	?><script language='Javascript'>
				document.location=('../index.php');
			</script><?php
			} 
	?>