<!DOCTYPE html>
<html>
<head>
    <title>Formulario de registro de empleado</title>
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
        <h2>Formulario de registro de empleado</h2>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre"><br>
            <input type="text" name="apellido" placeholder="Apellido"><br>
            <input type="text" name="cedula" placeholder="Cédula" oninput="this.value = this.value.replace(/[^0-9]/, '')"><br>
            <input type="text" name="usuario" placeholder="Usuario"><br>
            <input type="text" name="clave" placeholder="Clave"><br>
            <input type="submit" value="Guardar" name="guardar">
        </form>

        <?php
        include("conexion.php");

        if (!empty($_POST['guardar'])) {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $cedula = $_POST["cedula"];
            $usuario = $_POST["usuario"];
            $clave = $_POST["clave"];

            $query = "INSERT INTO empleado (emp_nombre, emp_apellido, emp_cedula, emp_usuario, emp_clave) 
                      VALUES ('$nombre', '$apellido', '$cedula', '$usuario', '$clave')";

            mysqli_query($conexion, $query);
        }

        if (!empty($_POST['eliminar'])) {
            $cod = $_POST["codigo"];
            $query = "DELETE FROM empleado WHERE emp_codigo = $cod";
            mysqli_query($conexion, $query);
        }

        if (!empty($_POST['modificar'])) {
            $cod = $_POST["codigo"];

            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $cedula = $_POST["cedula"];
            $usuario = $_POST["usuario"];
            $clave = $_POST["clave"];

            $query = "UPDATE empleado 
                      SET emp_nombre = '$nombre', emp_apellido = '$apellido', emp_cedula = '$cedula', 
                          emp_usuario = '$usuario', emp_clave = '$clave' 
                      WHERE emp_codigo = $cod";

            mysqli_query($conexion, $query);
        }

        $query = "SELECT * FROM empleado";
        $res = mysqli_query($conexion, $query);
        echo "<table border=1>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Usuario</th>
                <th>Clave</th>
            </tr>";

        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>
                <td>" . $row["emp_codigo"] . "</td>
                <td>" . $row["emp_nombre"] . "</td>
                <td>" . $row["emp_apellido"] . "</td>
                <td>" . $row["emp_cedula"] . "</td>
                <td>" . $row["emp_usuario"] . "</td>
                <td>" . $row["emp_clave"] . "</td>
                <td>
                    <form action='modificar.php' method='POST'>
                        <input type='hidden' name='codigo' value='" . $row["emp_codigo"] . "'>
                        <input type='submit' value='Modificar' name='modificar'>
                    </form>
                    <form action='eliminar.php' method='POST'>
                        <input type='hidden' name='codigo' value='" . $row["emp_codigo"] . "'>
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
