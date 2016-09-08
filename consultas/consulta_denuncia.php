<?php 
session_start();
if(isset($_SESSION["nombre"]) && !empty($_SESSION["nombre"]) && isset($_SESSION["apellido"]) && !empty($_SESSION["nombre"])){

$_SESSION['nombre'] = $_SESSION['nombre'];
$_SESSION['apellido'] = $_SESSION['apellido'];
$_SESSION['tipo'] = $_SESSION['tipo'];

?>
 <!DOCTYPE HTML>
<html lang="es">
	<head>
	<meta charset="UTF-8">
		<title>Venepol</title>
		<link rel="stylesheet" type="text/css" href="../css/menu.css"/>
		<script src="../includes/jquery.js"></script>
		<script>
		$(document).ready(function(){
			$(document).on('click',"#consultar",function(){
				var fecha_ini = $("#ano1").val()+"-"+$("#mes1").val()+"-"+$("#dia1").val();
				var fecha_fin = $("#ano2").val()+"-"+$("#mes2").val()+"-"+$("#dia2").val();
				var tabla = "denuncia";
				var url="../procesar/proc_fecha.php";

				$.ajax({
				type: "POST",
				url: url,
				data: {fecha_ini:fecha_ini,fecha_fin:fecha_fin,tabla:tabla},
				success: function(respuesta) {
					$("#consulta").html(respuesta);
				}
			});
			return false;
		});
			
			$(document).on('click',"#eliminar_denuncia",function(){
	
				var id = $(this).closest('tr').find(".id").text();
				var tr = $(this).closest('tr');
				var tabla ="denuncia";
				$.ajax({
						type:"post",
						url:"../procesar/eliminar.php",
						data:{id:id,tabla:tabla},
						beforeSend: function(){
						$("#capa").css("display","block").html("Eliminando");
					},
					success: function(respuesta){
						if(respuesta=='si'){
							$("#capa").css("background-color","green").fadeIn(200).html("<h3>Datos Eliminados</h3>").fadeOut(1000);
							tr.html("");
						}else{
							$("#capa").css("background-color","red").fadeIn(200).html("Error Al Eliminar datos de id: "+id+" para tabla: "+tabla).fadeOut(1000);
						}
					}
				});		
			});
			$(document).on('click',"#generar_acta",function(){
	
				var id = $(this).closest('tr').find(".id").text();
				window.location="../consultas/acta_denuncia.php?id_denuncia="+id;
			});
			});
			$(document).on('click',"#modificar_denuncia",function(){
			
				var id = $(this).closest('tr').find(".id").text();
				
				window.location="../formularios/form_denuncia_modal.php?id_denuncia="+id;
			});
		</script>
		</head>
		<body>
			<div id="inicio">
				<div id="banner">
					<img src="../recursos/LOGO-VENEPOL.png" id="img_banner">
				</div>
				<div id="capa"></div>
				<div id="usuario">
				<table id="panel">
						<tr>
							<td id="panel1">
								<?php
									echo "Bienvenido: ".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido']); 
								?>
							</td>
							<td id="panel">
								<a href="../procesar/iniciar.php">Menu Principal</a>
							</td>
							<td id="panel">
								<a href="../procesar/cerrar_session.php">Cerrar Sesion</a>
							</td>
						</tr>
				  </table>
				</div>
				<div id="menu">
						<table id="fecha">
                                                    <center><h1>Consultar Denuncias</h1></center></br>
							<tr>
									<form>	
									<td>DESDE:</td><td>
									<select id="ano1">
										<option value="2012">2012</option>
										<option value="2013">2013</option>
										<option value="2014">2014</option>
										<option value="2015">2015</option>
									</select>
									<select id="mes1">
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
									<select id="dia1">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
										<option value="24">24</option>
										<option value="25">25</option>
										<option value="26">26</option>
										<option value="27">27</option>
										<option value="28">28</option>
										<option value="29">29</option>
										<option value="30">30</option>
										<option value="31">31</option>
									</select>
							</td>
							<td rowspan="2">
								<button type="button" id="consultar">Consultar</button>
								</form>
							</td>
						</tr>
						<tr>
							<td>
								HASTA:
							</td>
							<td>
								<select id="ano2">
									<option value="2015">2015</option>
									<option value="2014">2014</option>
									<option value="2013">2013</option>
									<option value="2012">2012</option>
								</select>
								<select id="mes2">
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
								<select id="dia2">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>
								</select>
							</td>
						</tr>
                                                <tr>
							<td id='generar_acta'>
								<a href="../formularios/form_denuncia.php"><img src="../recursos/agregar.jpg" id='logo'><a/>
							</td>
						</tr>
					</table>
					</br>						
					<table id='consulta'>
					</table>
				</div>
		</body>
	</html>
<?php
}else{
	?><script language="Javascript">
	document.location=('../index.php');
	</script><?php
}
 ?>