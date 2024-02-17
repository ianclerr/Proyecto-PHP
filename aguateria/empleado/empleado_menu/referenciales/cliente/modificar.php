<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod = $_POST["codigo"];

    $query = "SELECT * FROM cliente WHERE cli_codigo = $cod";

    $res = mysqli_query($conexion, $query);
    while ($row = mysqli_fetch_array($res)) {
        $nombre = $row["cli_nombre"];
        $apellido = $row["cli_apellido"];
        $cedula = $row["cli_cedula"];
        $direccion = $row["cli_direccion"];
        $telefono = $row["cli_telefono"];
        $usuario = $row["cli_usuario"];
        $clave = $row["cli_clave"];
        $descripcion = $row["cli_descripcion"];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Datos del Cliente</title>
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
        form input[type="number"] {
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
        <form action="registrocliente.php" method="POST">
            <input type="text" name="nombre" placeholder='Nombre' value="<?php echo $nombre; ?>">
            <input type="text" name="apellido" placeholder='Apellido' value="<?php echo $apellido; ?>">
            <input type="text" name="cedula" placeholder='Cedula' value="<?php echo $cedula; ?>">
            <input type="text" name="direccion" placeholder='Direccion' value="<?php echo $direccion; ?>">
            <input type="text" name="telefono" placeholder='Telefono' value="<?php echo $telefono; ?>">
            <input type="text" name="usuario" placeholder='Usuario' value="<?php echo $usuario; ?>">
            <input type="text" name="clave" placeholder='Clave' value="<?php echo $clave; ?>">
            <input type="text" name="descripcion" placeholder='Descripcion' value="<?php echo $descripcion; ?>">
            <input type="hidden" name="codigo" value="<?php echo $cod; ?>">
            <input type="submit" value="Modificar" name="modificar">
        </form>
    </div>
</body>
</html>
