<?php
    session_start(); 
    session_destroy();
    session_start();
    
    include("conexion.php");

    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    $consulta = "SELECT * FROM cliente WHERE cli_usuario='$usuario' AND cli_clave='$clave'";
    $res = mysqli_query($conexion, $consulta);

    if (!$res) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    $ban = 0;
    while ($fila = mysqli_fetch_assoc($res)) {
        $ban = 1;
        $nombre = $fila["cli_nombre"];
        $codigo = $fila["cli_codigo"];
        $_SESSION["usuario"] = $nombre;
        $_SESSION["codigo"] = $codigo;
    }

    if ($ban == 1) {
        header('Location: /solicitud/solicitud.php');
    } else {
        echo "Datos Incorrectos";
    }
?>
