<?php
include("conexion.php");

$cod = $_POST["codigo"];
$query = "SELECT * FROM tipodempleado WHERE tip_codigo = $cod";
$res = mysqli_query($conexion, $query);

if ($row = mysqli_fetch_array($res)) {
    $nombre = $row["tip_nombre"];
    $apellido = $row["tip_apellido"];
    $cedula = $row["tip_cedula"];
    $telefono = $row["tip_telefono"];
    $tipo_empleado = $row["tip_empleado"];
    $descripcion = $row["tip_descripcion"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Datos</title>
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: fit-content;
            margin: 20px auto;
        }

        form input[type="text"],
        form input[type="number"],
        form select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="tipoempleado.php" method="POST">
            <input type="text" name="nombre" placeholder='Nombre' value="<?php echo $nombre; ?>">
            <input type="text" name="apellido"  placeholder='Apellido' value="<?php echo $apellido; ?>">
            <input type="number" name="cedula"  placeholder='Cedula' value="<?php echo $cedula; ?>">
            <input type="number" name="telefono"  placeholder='Telefono' value="<?php echo $telefono; ?>">

            <select name="tip_empleado">
    <option value="Delivery" <?php echo ($tipo_empleado == 'Delivery') ? 'selected' : ''; ?>>Delivery</option>
    <option value="Mantenimiento" <?php echo ($tipo_empleado == 'Mantenimiento') ? 'selected' : ''; ?>>Mantenimiento</option>
    <option value="Administrador" <?php echo ($tipo_empleado == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
    <option value="Secretario" <?php echo ($tipo_empleado == 'Secretario') ? 'selected' : ''; ?>>Secretario</option>
</select>


            <input type="text" name="descripcion" placeholder='Descripcion' value="<?php echo $descripcion; ?>">
            <input type="hidden" name="codigo" value="<?php echo $cod; ?>">
            <input type="submit" value="Modificar" name="modificar">
        </form>
    </div>
</body>
</html>
