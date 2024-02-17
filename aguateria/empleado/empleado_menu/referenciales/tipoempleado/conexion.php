<?php 
$servidor 	 = "localhost";
$usuario 	 = "aguater_admin";
$clave 		 = "ciUTK(UxGzkF";
$basededatos = "aguater_bd";

$conexion = mysqli_connect("$servidor","$usuario","$clave","$basededatos");

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

mysqli_set_charset($conexion,"utf8");

?>