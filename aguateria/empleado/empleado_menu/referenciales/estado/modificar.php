<?php
include("conexion.php");

if (!empty($_POST['guardar'])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $cedula = $_POST["cedula"];
    $telefono = $_POST["telefono"];
    $descripcion = $_POST["descripcion"];

    $query = "INSERT INTO registroempleado (reg_nombre, reg_apellido, reg_cedula, reg_telefono, reg_descripcion) 
              VALUES ('$nombre', '$apellido', '$cedula', '$telefono', '$descripcion')";

    mysqli_query($conexion, $query);
}

if (!empty($_POST['eliminar'])) {
    $cod = $_POST["codigo"];
    $query = "DELETE FROM registroempleado WHERE reg_codigo = $cod";
    mysqli_query($conexion, $query);
}

if (!empty($_POST['modificar'])) {
    $cod = $_POST["codigo"];

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $cedula = $_POST["cedula"];
    $telefono = $_POST["telefono"];
    $descripcion = $_POST["descripcion"];

    $query = "UPDATE registroempleado 
              SET reg_nombre = '$nombre', reg_apellido = '$apellido', reg_cedula = '$cedula', 
                  reg_telefono = '$telefono', reg_descripcion = '$descripcion' 
              WHERE reg_codigo = $cod";

    mysqli_query($conexion, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Datos de Empleado</title>
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
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre"><br>
            <input type="text" name="apellido" placeholder="Apellido"><br>
            <input type="text" name="cedula" placeholder="Cédula" oninput="this.value = this.value.replace(/[^0-9]/, '')"><br>
            <input type="text" name="telefono" placeholder="Teléfono" oninput="this.value = this.value.replace(/[^0-9]/, '')"><br>
            <input type="text" name="descripcion" placeholder="Descripción"><br>
            <input type="submit" value="Guardar" name="guardar">
        </form>

        <?php
        $query = "SELECT * FROM registroempleado";
        $res = mysqli_query($conexion, $query);
        echo "<table border=1>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>";

        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>
                <td>" . $row["reg_codigo"] . "</td>
                <td>" . $row["reg_nombre"] . "</td>
                <td>" . $row["reg_apellido"] . "</td>
                <td>" . $row["reg_cedula"] . "</td>
                <td>" . $row["reg_telefono"] . "</td>
                <td>" . $row["reg_descripcion"] . "</td>
                <td>
                    <form action='modificar.php' method='POST'>
                        <input type='hidden' name='codigo' value='" . $row["reg_codigo"] . "'>
                        <input type='submit' value='Modificar' name='modificar'>
                    </form>
                    <form action='eliminar.php' method='POST'>
                        <input type='hidden' name='codigo' value='" . $row["reg_codigo"] . "'>
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
