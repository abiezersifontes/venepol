<?php session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
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
			$(document).on('click','#consultar',function(){
				var funcionario = $('input:text[name=funcionario]').val();
				var url = "../procesar/proc_funcionario.php";
				$.ajax({
					type:'post',
					url: url,
					data:{funcionario:funcionario},
					success:function(respuesta){
						$('#consulta').html(respuesta);
					}
				});
			});
		
		$(document).on('click',"#eliminar_funcionario",function(){

			var id = $(this).closest('tr').find(".id").text();
			var tr = $(this).closest('tr');
			var tabla = "funcionario";
			
			alert("Esta es el id: "+id+", la tabla es: "+tabla);
	
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
					$("#capa").css("background-color","red").fadeIn(200).html("Error Al Eliminar datos").fadeOut(1000);
				}
			}
		});
		});

		$(document).on('click',"#modificar_funcionario",function(){
				var id = $(this).closest('tr').find(".id").text();
				
				window.location="../formularios/form_funcionario_modal.php?id_funcionario="+id;
		});

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
									echo "Bienvenido:".ucwords($_SESSION['nombre'])." ".ucwords($_SESSION['apellido']); 
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
				<div id="fun">
					<table id="fun">
                       	<center><h1>Consultar Funcionario</h1></center></br>
						<tr>
							<td>Cedula del Funcionario:</td>
							<td>
								<form>
									<input id="consulta_fun" type="text" name="funcionario"/>
									<button type="button" id="consultar">Consultar</button>
								</form>
							</td>
						</tr>
						<tr>
							<td id='generar_acta'>
                                <a href="../formularios/form_funcionario.php"><img src="../recursos/agregar.jpg" id='logo'><a/>
							</td>
						</tr>
					</table>
				</div>
			</br></br></br></br></br></br>
			<table id="consulta">
			</table>	
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