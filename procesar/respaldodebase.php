<?php
session_start();

if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){

if($_SESSION['tipo']=="administrador"){

require("../includes/respaldo.php");

$base =  new Conexion();

$base->conectar();

$base->respaldo();

$base->cerrar();



}else{
echo "<script>
        window.location='../index.php';
    </script>
";


}




}else{

echo "<script>
        window.location='../index.php';
    </script>
";
}



?>
