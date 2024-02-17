<?php
    //Variable local vs Variable Global//
    session_start(); //Creamos una nueva sesion
    session_destroy();
    session_start();
    //tener acceso al archivo conexion
    include("conexion.php");
    //Recibir variables
    $usuario=$_POST["usuario"];
    $clave=$_POST["clave"];

    $consulta="SELECT * 
            FROM empleado 
            WHERE emp_usuario='$usuario' 
            AND emp_clave='$clave'";

    //linea de ejecucion
    // $res = mysqli_query($conexion,$consulta);
    $res = mysqli_query($conexion, $consulta);

if (!$res) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

    $ban=0;
    while ($fila = mysqli_fetch_assoc($res)) {
        $ban=1;
        $nombre=$fila["emp_nombre"];
        $codigo=$fila["emp_codigo"];
        $_SESSION["usuario"]=$nombre;
        $_SESSION["codigo"]=$codigo;
    }

    if($ban==1){
        //redireccionar
        header('Location: /empleado/empleado_menu/index.php');
    } else {
        echo "Datos Incorrectos";
    }
    
?>