<?php

$mensaje = null;

if (isset($_POST["ajax"]))
{
    $fecha = htmlspecialchars($_POST["fecha"]);
    $hora = htmlspecialchars($_POST["hora"]);
    $descripcion = htmlspecialchars($_POST["descripcion"]);
    
    if ($fecha == '')
    {
        echo $mensaje = "debe ingresar todos los campos";
    }
	else if ($hora == '')
    {
        echo $mensaje = "debe ingresar todos los campos";
    }	
	else if ($descripcion == '')
    {
        echo $mensaje = "debe ingresar todos los campos";
    }
	else
	{
		echo $mensaje = "<script>window.location='../procesar/reg_novedad.php';</script>";
	}
}
?>