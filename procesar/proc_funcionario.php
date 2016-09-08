<?php
include("../includes/conexion.php");
$con = conectar();
$funcionario = $_POST['funcionario'];
$query = "SELECT * FROM funcionario WHERE cedula_f='".$funcionario."'";
$consulta = mysqli_query($con, $query);


if(mysqli_num_rows($consulta)){
?>
<tr>		
	<th id='id'>ID</th>
	<th>Cedula</th>
	<th>Nombre</th>
	<th>Apellido</th>
	<th>Modificar</th>
	<th>Eliminar</th>
</tr>";
<?php
while($row=mysqli_fetch_array($consulta)){
	?><tr>
		<td class='id'><?php echo $id=$row['id_Funcionario']; ?></td>
		<td><?php echo $row['cedula_f'];?></td>
		<td><?php echo $row['nombre_f'];?></td>
		<td><?php echo $row['apellido_f'];?></td>
		<td id='modificar_funcionario'><img src='../recursos/modificar.png' id='logo'> </td>
		<td id='eliminar_funcionario'><img src='../recursos/eliminar.png' id='logo'> </td>
		</tr><?php
}
}else{
	?> </br><strong>El Usuario no esta Registrado</strong></br><?php
}
?>