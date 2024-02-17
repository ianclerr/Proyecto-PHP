<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Registro Tipo Empleado</title>
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
        <h2>Formulario Registro Tipo Empleado</h2>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre"><br>
            <input type="text" name="apellido" placeholder="Apellido"><br>
            <input type="text" name="cedula" placeholder="Cédula" oninput="this.value = this.value.replace(/[^0-9]/, '')"><br>
            <input type="text" name="telefono" placeholder="Teléfono" oninput="this.value = this.value.replace(/[^0-9]/, '')"><br>
            <select name="tip_empleado">
                <option value="Delivery">Delivery</option>
                <option value="Mantenimiento">Mantenimiento</option>
                <option value="Administrador">Administrador</option>
                <option value="Secretario">Secretario</option>
            </select><br>
            <input type="text" name="descripcion" placeholder="Descripción"><br>
            <input type="submit" value="Guardar" name="guardar">
        </form>

        <?php
        include("conexion.php");

        if (!empty($_POST['guardar'])) {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $cedula = $_POST["cedula"];
            $telefono = $_POST["telefono"];
            $tip_empleado = $_POST["tip_empleado"];
            $descripcion = $_POST["descripcion"];

            $query = "INSERT INTO tipodempleado (tip_nombre, tip_apellido, tip_cedula, tip_telefono, tip_empleado, tip_descripcion) 
                      VALUES ('$nombre', '$apellido', '$cedula', '$telefono', '$tip_empleado', '$descripcion')";

            mysqli_query($conexion, $query);
        }

        if (!empty($_POST['eliminar'])) {
            $cod = $_POST["codigo"];
            $query = "DELETE FROM tipodempleado WHERE tip_codigo = $cod";
            mysqli_query($conexion, $query);
        }

        if (!empty($_POST['modificar'])) {
            $cod = $_POST["codigo"];

            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $cedula = $_POST["cedula"];
            $telefono = $_POST["telefono"];
            $tip_empleado = $_POST["tip_empleado"];
            $descripcion = $_POST["descripcion"];

            $query = "UPDATE tipodempleado 
                      SET tip_nombre = '$nombre', tip_apellido = '$apellido', tip_cedula = '$cedula', 
                          tip_telefono = '$telefono', tip_empleado = '$tip_empleado', tip_descripcion = '$descripcion' 
                      WHERE tip_codigo = $cod";

            mysqli_query($conexion, $query);
        }
        ?>

        <table border=1>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Tipo Empleado</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            <?php
            $query = "SELECT * FROM tipodempleado";
            $res = mysqli_query($conexion, $query);

            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>
                    <td>" . $row["tip_codigo"] . "</td>
                    <td>" . $row["tip_nombre"] . "</td>
                    <td>" . $row["tip_apellido"] . "</td>
                    <td>" . $row["tip_cedula"] . "</td>
                    <td>" . $row["tip_telefono"] . "</td>
                    <td>" . $row["tip_empleado"] . "</td>
                    <td>" . $row["tip_descripcion"] . "</td>
                    <td>
                        <form method='POST' action='modificar.php'>
                            <input type='hidden' name='codigo' value='" . $row["tip_codigo"] . "'>
                            <input type='submit' value='Modificar' name='modificar'>
                        </form>
                        <form method='POST' action='eliminar.php'>
                            <input type='hidden' name='codigo' value='" . $row["tip_codigo"] . "'>
                            <input type='submit' value='Eliminar' name='eliminar'>
                        </form>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
