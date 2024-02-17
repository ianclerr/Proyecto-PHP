<?php 
session_start();
$nombre = $_SESSION["usuario"];
$codigo = $_SESSION["codigo"];

if($codigo > 0){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proyecto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="bidon.jpg" type="image/x-icon">
</head>
<body>
    <section class="navigation">
        <nav>
            <div class="nav-movil">
                <a id="nav-boton" href="#!">
                    <span></span>
                </a>
            </div>
            <ul class="nav-menu">
                <li> <a href="javascript:void(0)">Referenciales</a>
                    <ul class="nav-submenu">
                        <li><a href="/empleado/empleado_menu/estado/estado.php">Estado</a></li>
                        <li><a href="/empleado/empleado_menu/tipoempleado/tipoempleado.php">Tipo De Empleado</a></li>
                        <li><a href="/empleado/empleado_menu/cliente/registrocliente.php">Cliente</a></li> 
                        <li><a href="/empleado/empleado_menu/empleado/registroempleado.php">Empleado</a></li> 
                    </ul> 
                </li>
            </ul>

            <ul class="nav-menu">
                <li> <a href="javascript:void(0)">Movimientos</a>
                    <ul class="nav-submenu">
                        <li><a href="https://aguateriaelbidon.com/empleado/empleado_menu/movimientos/registraraprobacion/reg_aprobacion.php">Registrar Aprobacion</a></li>
                        <li><a href="https://aguateriaelbidon.com/empleado/empleado_menu/movimientos/registrarinstalacion/reg_instalacion.php">Registrar Instalacion</a></li>
                        <li><a href="https://aguateriaelbidon.com//empleado/empleado_menu/movimientos/registrarmantenimiento/reg_mantenimiento.php">Registrar Mantenimiento</a></li>
                    </ul> 
                </li>
            </ul>

            <ul class="nav-menu">
                <li> <a href="javascript:void(0)">Informes</a>
                    <ul class="nav-submenu">
                        <li><a href="https://aguateriaelbidon.com/empleado/empleado_menu/informes/informessolicitud.php">Informes De Solicitud</a></li>
                        <li><a href="https://aguateriaelbidon.com/empleado/empleado_menu/informes/informeaprobacion/inf_aprobacion.php">Informe Aprobacion</a></li>
                        <li><a href="https://aguateriaelbidon.com/empleado/empleado_menu/informes/informeinstalacion/inf_instalacion.php">Informe De Instalacion</a></li>
                        <li><a href="https://aguateriaelbidon.com/empleado/empleado_menu/informes/informemantenimiento/inf_mantenimiento.php">Informe Mantenimiento</a></li>
                        
                    </ul> 
                </li>
            </ul>

            <ul class="nav-menu">
                <li> <a href="logout.php">Cerrar Sesion de: <?php echo $nombre; ?></a></li>
            </ul>
        </nav>
    </section>

    <img width="60%" height="50%" src="bidon.jpg" class="bidon">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src="./script.js"></script>
</body>
</html>

<?php 
} else {
    echo "Inicie sesión para ver esta página";
}
?>
