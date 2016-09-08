<?php session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>

<title>Denuncia</title>

<link rel="stylesheet" type="text/css" href="../css/estilos.css">
<script type="text/javascript" src="../includes/jquery.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		$("#estado_D").change(function(){
			
			$("#estado_D option:selected").each(function(){
            	var ubicacion = $(this).val();
				var tabla = "municipio";
            	$.post("../procesar/proc_ubicacion.php",{ubicacion:ubicacion,tabla:tabla}, function(data){
            		$("#municipio_D").html(data);
				});
			});
		});
	});
	$(document).ready(function(){
		$("#municipio_D").change(function(){
			$("#municipio_D option:selected").each(function(){
            	var ubicacion = $(this).val();
				var tabla = "parroquia";
            	$.post("../procesar/proc_ubicacion.php",{ubicacion:ubicacion,tabla:tabla}, function(data){
						$("#parroquia_D").html(data);
					});
			});
		});
	});
	
	$(document).ready(function(){
		$("#estado_H").change(function(){
			
			$("#estado_H option:selected").each(function(){
            	var ubicacion = $(this).val();
				var tabla = "municipio";
            	$.post("../procesar/proc_ubicacion.php",{ubicacion:ubicacion,tabla:tabla}, function(data){
            		$("#municipio_H").html(data);
				});
			});
		});
	});
	$(document).ready(function(){
		$("#municipio_H").change(function(){
			$("#municipio_H option:selected").each(function(){
            	var ubicacion = $(this).val();
				var tabla = "parroquia";
            	$.post("../procesar/proc_ubicacion.php",{ubicacion:ubicacion,tabla:tabla}, function(data){
						$("#parroquia_H").html(data);
					});
			});
		});
	});
		 $(document).ready(function(){
		 $(".btn").click(function(){
			$.ajax({
				   type: "POST",
				   url: '../procesar/mod_denuncia.php',
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
			<form id="form">
				<table class="cuerpo">
				<tr>
					<td colspan="2">
						<h1>Registro de Denuncias </h1>
						<div id="validacion">
								<!-- este div contiene el resultado de la validacion-->						
						</div>
					</td>
					<td>
				</tr>
				<tr id="division">
					<td id="division">
						<div class="formulario1">
							<?php
							require_once("../includes/conexion.php");
							$con = conectar();
							$q1 = mysqli_query($con, "SELECT * FROM denuncia WHERE id_denuncia = '".$_GET['id_denuncia']."'");

							while($dato = mysqli_fetch_array($q1)){
								$id_denuncia = $dato['id_denuncia'];
								$fecha1 = $dato['fecha'];
								$hora1 = $dato['hora'];
								$delitos = $dato['delitos'];
								$relato = $dato['relato'];
								$estado_H = $dato['estado'];
								$municipio_H = $dato['municipio'];
								$ciudad_H = $dato['ciudad'];
								$parroquia_H = $dato['parroquia'];
								$calle_H = $dato['calle'];
								$cuadrante_H = $dato['cuadrante'];
								$preguntas_y_respuestas = $dato['preguntas_y_respuestas'];
								$denunciante_cedula = $dato['denunciante_cedula'];
								$denuncia_id_funcionario = $dato['denuncia_id_funcionario'];
							}

							$q2 = mysqli_query($con,"SELECT * FROM denunciante WHERE cedula = '".$denunciante_cedula."'");

							while($dato = mysqli_fetch_array($q2)){
								$nac = $dato['nac'];
								$cedula = $dato['cedula'];
								$nombres = $dato['nombres'];
								$apellidos = $dato['apellidos']; 
								$edad = $dato['edad'];
								$sexo = $dato['sexo'];
								$telefono = $dato['telefono'];
								$profesion = $dato['profesion'];
								$estado_D = $dato['estado'];
								$municipio_D = $dato['municipio'];
								$ciudad_D = $dato['ciudad'];
								$parroquia_D = $dato['parroquia'];
								$calle_D = $dato['calle'];
							}
							$fecha = explode("-", $fecha1);
							$hora = explode(":", $hora1);


							?>
							<table id="division">							
								<tr>
									<td height="37" colspan="2" align="center" bordercolor="#3E8EFF" bgcolor="#ECE9D8"><strong>Datos de Denunciante</strong>
									</td>
								</tr>
								<tr>
									<td>Cedula<span id="red">(*)</span></td>
									<td>
									
										<select id="nac" name="nac">
											<option selected="<?php echo $nac; ?>"><?php echo $nac; ?></option>
											<option value="V">V</option>
											<option value="E">E</option>		  
										</select>
										<input type="text" value="<?php echo $cedula;?>" name="cedula" id="cedula"/>
									</td>
								</tr>
								<tr>
									
									<td>Nombres<span id="red">(*)</span></td>
									<td>
										<input type="text" value="<?php echo $nombres; ?>" name="nombres" id="nombres"/>
									</td>
								</tr>
								<tr>
									<td>Apellidos<span id="red">(*)</span></td>
									<td>
										<input type="text" value="<?php echo $apellidos; ?>" name="apellidos" id="apellidos"/>
								</td>
								</tr>
								<tr>
									<td>Edad<span id="red">(*)</span></td>
									<td>
										<input type="text" value="<?php echo $edad; ?>" name="edad" id="edad"/>
									</td>
								</tr>
								<tr>
									<td>Sexo<span id="red">(*)</span></td>
									<td>
										<?php
										if ($sexo == "femenino") {
											?>Femenino <input type="radio" value="masculino" name="sexo" id="sexo"/>
											Masculino <input type="radio" value="femenino" checked="checked" name="sexo" id="sexo"/><?php
										}else{
											?>Femenino <input type="radio" value="masculino" checked="checked" name="sexo" id="sexo"/>
											Masculino <input type="radio" value="femenino"  name="sexo" id="sexo"/><?php
											}
										?>
									</td>
								</tr>
								<tr>
									<td>Telefono<span id="red">(*)</span></td>
									<td> 
										<input type="text" value="<?php echo $telefono; ?>" name="telefono" id="telefono"/>
									</td>
								</tr>
								<tr>
									<td>Profesion<span id="red">(*)</span></td>
									<td>
										<input type="text" value="<?php echo $profesion; ?>" name="profesion" id="profesion"/>
									</td>
								</tr>
								<tr>
									<td>Estado<span id="red">(*)</span></td>
									<td>
										<select name="estado_D" id="estado_D">
										<option selected="selected" value="<?php echo $estado_D; ?>"><?php echo $estado_D; ?></option>
											<?php
												$con =conectar();
												$query="SELECT * FROM estado";
												$consulta=mysqli_query($con, $query);
												
												while($row=mysqli_fetch_array($consulta)){
												
													echo "<option value=\"".$row['id']."\">".utf8_encode($row['nombre'])."</option>"; 
												
												} 
											?>
										</select>
								</td>
								</tr>
								<tr>
								  <td>Municipio<span id="red">(*)</span></td>
								  <td>
									  <select name="municipio_D" id="municipio_D">
									  <option selected="selected" value="<?php echo $municipio_D; ?>"><?php echo $municipio_D; ?></option>
									  </select>
								  </td>
								</tr>
								<tr>
								<tr>
								  <td>Parroquia<span id="red">(*)</span></td>
								  <td>
									  <select name="parroquia_D" id="parroquia_D">
									  <option selected="selected" value="<?php echo $parroquia_D; ?>"><?php echo $parroquia_D; ?></option>
									  </select>
								  </td>
								</tr>
								<td>Ciudad<span id="red">(*)</span></td>
								  <td>
									  <input type="text" value="<?php echo $ciudad_D; ?>" name="ciudad_D" id="ciudad_D"/>
								  </td>
								</tr>
								<tr>
								  <td>Calle/Av<span id="red">(*)</span></td>
								  <td>
									  <input type="text" value="<?php echo $calle_D; ?>" name="calle_D" id="calle_D"/>
								  </td>
								</tr>
								<tr>
									<td>N&ordm; Domicilio<span id="red">(*)</span></td>
								  <td>
									  <input type="text" value="<?php echo $ciudad_D; ?>" name="n_domicilio_D" id="n_domicilio_D"/>
								  </td>
								</tr>
								<tr>
									<td height="37" colspan="2" align="center" bordercolor="#3E8EFF" bgcolor="#ECE9D8">
										<strong>Datos del Delito</strong>
									</td>
								</tr>
								<tr>
								  <td>Fecha<span id="red">(*)</span></td>
								  <td>
										<select name="dia" id="dia">
											<option value="<?php echo $fecha['2']; ?>"><?php echo $fecha['2']; ?></option>
											<?php for($i=01;$i<=31;$i++){
												?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php
											} ?>
										</select>
										<select name="mes" id="mes">
											
											<option selected="selected" value="<?php echo $fecha['1']; ?>"><?php echo $fecha['1']; ?></option>
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
											<option value="12">Diciembre</option>
										</select>
										<select name="ano" id="ano">
											<option selected="selected" value="<?php echo $fecha['0']; ?>"><?php echo $fecha['0']; ?></option>
											<option value="2015">2015</option>
											<option value="2014">2014</option>
											<option value="2013">2013</option>
											<option value="2012">2012</option>
											<option value="2011">2011</option>
											<option value="2010">2010</option>
										</select>
								  </td>
								</tr>
								<tr>
									<td>Hora<span id="red">(*)</span></td>
									<td>
									<select name="hora" id="hora">
										<option value="<?php echo $hora['0']; ?>"><?php echo $hora['0']; ?></option>
										<?php for($i=0;$i<=23;$i++){
											?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php
										} ?>
									</select>
									:
									<select name="minu" id="minu">
										<option value="<?php echo $hora['1']; ?>"><?php echo $hora['1']; ?></option>
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
								<tr>
								  <td>Delitos<span id="red">(*)</span></td>
								  <td>
										<input type="text" value="<?php echo $delitos; ?>" id="delito" name="delito">
									</div>
								  </td>
								<tr>
								  <td>Relato<span id="red">(*)</span></td>
								  <td>
									  <textarea name="relato_H" placeholder="Escriba el Relato del Denunciante..." id="relato_H"><?php echo $relato; ?></textarea>
								  </td>
								</tr>
				  </table>
							
							<td id="division">
							<div class="formulario2">
							  <table id="division">
								<tr>
								  <td height="37" colspan="2" align="center" bordercolor="#3E8EFF" bgcolor="#ECE9D8"><div align="center"><strong>Lugar de los Hechos</strong></div></td>
								</tr>
								<tr>
								  <td>Estado<span id="red">(*)</span></td>
								  <td>
									  <select name="estado_H" id="estado_H">
										<option value="<?php echo $estado_H; ?>" selected="selected"><?php echo $estado_H; ?></option>
										<?php
										$query = "SELECT * FROM estado";
										$consulta = mysqli_query($con,$query);
										
										while($row=mysqli_fetch_array($consulta)){
										
											echo "<option value=\"".$row['id']."\">".utf8_encode($row['nombre'])."</option>"; 
										} 
										?>
									  </select>
								  </td>
								</tr>
								<tr>
								  <td>Municipio<span id="red">(*)</span></td>
								  <td>
									  <select name="municipio_H" id="municipio_H">
									  <option value="<?php echo $municipio_H; ?>" selected="selected"><?php echo $municipio_H; ?></option>
									  </select>
								  </td>
								</tr>
								<tr>
								  <td>Parroquia<span id="red">(*)</span></td>
								  <td>
									  <select type="text" name="parroquia_H" id="parroquia_H">
									  <option value="<?php echo $parroquia_H; ?>" selected="selected"><?php echo $parroquia_H; ?></option>
									  </select>
								  </td>
								</tr>
								<tr>
								  <td>Ciudad<span id="red">(*)</span></td>
								  <td>
									  <input type="text" value="<?php echo $ciudad_H; ?>" name="ciudad_H" id="ciudad_H"/>
								  </td>
								</tr>
								<tr>
								  <td>Calle/Av<span id="red">(*)</span></td>
								  <td>
									  <input type="text" value="<?php echo $calle_H; ?>" name="calle_H" id="calle_H"/>
								  </td>
								</tr>
								<tr>
								  <td>Cuadrante<span id="red">(*)</span></td>
								  <td>
									<input type="text" value="<?php echo $cuadrante_H; ?>" name="cuadrante_H" id="cuadrante_H"/>
								  </td>
								</tr>
								<tr>
								<tr>
								 <td height="37" colspan="2" align="center" bordercolor="#3E8EFF" bgcolor="#ECE9D8"><div align="center"><strong>Preguntas y Respuestas</strong></div></td>
								</tr>
								<tr>
								  <td>Preguntas<br/>y<br/>Respuestas<span id="red">(*)</span></td>
								  <td>
									<textarea name="preguntas_y_respuestas" id="preguntas_y_respuestas" placeholder="Escriba las Preguntas y Respuestas..."><?php echo $preguntas_y_respuestas; ?></textarea>
								  </td>
								</tr>
				</table>
				</div>
				</td>
				
				<tr id="division">
				<td colspan="2">
				<input type="hidden" name="ajax" id="ajax">
				<input type="hidden" name="id_denuncia_mod" value="<?php echo $_GET['id_denuncia']; ?>">
				<input type="hidden" name="id_denunciante_mod" value="<?php echo $denunciante_cedula; ?>">
				<input name="guardar" class="btn" id="guardar" type="submit" value="Guardar" />
				</td>
				</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
<?php }else{
	echo 	"<script language='Javascript'>
				document.location=('../index.php');
			</script>";
			} 
	?>