<?php 
session_start();
	if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['apellido']) && !empty($_SESSION['apellido']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']))
	{

		if(isset($_POST["fecha_ini"]) && !empty($_POST['fecha_ini']) && isset($_POST["fecha_fin"]) && !empty($_POST['fecha_fin']))
		{
			require_once("../includes/conexion.php");
			$con = conectar();
			$fecha_ini = $_POST['fecha_ini'];
			$fecha_fin = $_POST['fecha_fin'];
			$tabla = $_POST['tabla'];
			$query = "SELECT * FROM ".$tabla." WHERE fecha BETWEEN '".$fecha_ini."' AND '".$fecha_fin."' ORDER BY fecha ASC LIMIT 0,10";
			$resultado = mysqli_query($con, $query);
			
			if(trim($_SESSION['tipo'])=="administrador"){
				if(mysqli_num_rows($resultado)){	
					?><tr>		
							<th id='id'>ID</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Eliminar</th>
							<th>Modificar</th>
							<th>Acta</th>
						</tr><?php
		
					
					while($dato=mysqli_fetch_array($resultado)){
		
						?><tr><td class='id'><?php echo $id=$dato['id_'.$tabla.'']; ?></td><?php
						?><td><?php echo $dato['fecha']; ?></td><?php
						?><td><?php echo $dato['hora']; ?></td><?php
						echo "<td id='eliminar_".$tabla."'><img src='../recursos/eliminar.png' id='logo'></td>";
						echo "<td id='modificar_".$tabla."'><img src='../recursos/modificar.png' id='logo'></td>";
						?><td id='generar_acta'><img src='../recursos/acta.png' id='logo'> </td>"</tr><?php
					}
				}else{
					?></br> No se Han Encontrado Registros Para el Rango de fechas <?php
				}

			}else{
				if(mysqli_num_rows($resultado)){	
					?><tr>		
							<th id='id'>ID</th>
							<th>Fecha</th>
							<th>Hora</th>				
							<th>Modificar</th>
							<th>Acta</th>
						</tr><?php
		
					
					while($dato=mysqli_fetch_array($resultado)){
		
						?><tr><td class='id'><?php echo $id=$dato['id_'.$tabla.'']; ?></td><?php
						?><td><?php echo $dato['fecha']; ?></td><?php
						?><td><?php echo $dato['hora']; ?></td><?php
						echo "<td id='modificar_".$tabla."'><img src='../recursos/modificar.png' id='logo'></td>";
						?><td id='generar_acta'><img src='../recursos/acta.png' id='logo'> </td>"</tr><?php
					}
				}else{
					?></br> No se Han Encontrado Registros Para el Rango de fechas <?php
				}
			}
			}else{
				?></br> <p>El Servidor no recibe los datos</p><?php
			}
	}else
	{
		?><script language='Javascript'>
			document.location=('../index.php');
		</script><?php
	}
?>
	