<?php
include("conexion.php");

if (!empty($_POST['guardar'])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $cedula = $_POST["cedula"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    $descripcion = $_POST["descripcion"];

    $query = "INSERT INTO cliente (cli_nombre, cli_apellido, cli_cedula, cli_direccion, cli_telefono, cli_usuario, cli_clave, cli_descripcion) 
              VALUES ('$nombre', '$apellido', '$cedula', '$direccion', '$telefono', '$usuario', '$clave', '$descripcion')";

    mysqli_query($conexion, $query);
}

if (!empty($_POST['eliminar'])) {
    $cod = $_POST["codigo"];
    $query = "DELETE FROM cliente WHERE cli_codigo = $cod";
    mysqli_query($conexion, $query);
}

if (!empty($_POST['modificar'])) {
    $cod = $_POST["codigo"];

    $usuario = $_POST["usuario"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $cedula = $_POST["cedula"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $clave = $_POST["clave"];
    $descripcion = $_POST["descripcion"];

    $query = "UPDATE cliente 
              SET cli_usuario = '$usuario', cli_nombre = '$nombre', cli_apellido = '$apellido', cli_cedula = '$cedula', cli_direccion = '$direccion', cli_telefono = '$telefono', cli_clave = '$clave', cli_descripcion = '$descripcion'
              WHERE cli_codigo = $cod";

    mysqli_query($conexion, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario Registro Cliente</title>
    <!-- Estilos CSS -->
    <style>
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
        }

        form input[type="text"],
        form input[type="submit"] {
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
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        form .action-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        form .action-buttons input[type="submit"] {
            padding: 6px 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulario Registro Cliente</h2>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre"><br>
            <input type="text" name="apellido" placeholder="Apellido"><br>
            <input type="text" name="cedula" placeholder="Cédula"><br>
            <input type="text" name="direccion" placeholder="Dirección"><br>
            <input type="text" name="telefono" placeholder="Teléfono" oninput="this.value = this.value.replace(/[^0-9]/, '')"><br>
            <input type="text" name="usuario" placeholder="Usuario"><br>
            <input type="text" name="clave" placeholder="Clave"><br>
            <input type="text" name="descripcion" placeholder="Descripción"><br>
            <input type="submit" value="Guardar" name="guardar">
        </form>

        <?php
        $query = "SELECT * FROM cliente";
        $res = mysqli_query($conexion, $query);
        echo "<table border=1>
            <tr>
                <th>Código</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Clave</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>";

        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>
                <td>" . $row["cli_codigo"] . "</td>
                <td>" . $row["cli_usuario"] . "</td>
                <td>" . $row["cli_nombre"] . "</td>
                <td>" . $row["cli_apellido"] . "</td>
                <td>" . $row["cli_cedula"] . "</td>
                <td>" . $row["cli_direccion"] . "</td>
                <td>" . $row["cli_telefono"] . "</td>
                <td>" . $row["cli_clave"] . "</td>
                <td>" . $row["cli_descripcion"] . "</td>
                <td>
                    <form method='POST' action='modificar.php'>
                        <input type='hidden' name='codigo' value='" . $row["cli_codigo"] . "'>
                        <input type='submit' value='Modificar' name='modificar'>
                    </form>
                    <form method='POST' action='eliminar.php'>
                        <input type='hidden' name='codigo' value='" . $row["cli_codigo"] . "'>
                        <input type='submit' value='Eliminar' name='eliminar'>
                    </form>
                </td>
            </tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>
</html>
