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
        <?php
        include("conexion.php");
        $cod = $_POST["codigo"];
        $query = "SELECT * FROM empleado WHERE emp_codigo = $cod";

        $res = mysqli_query($conexion, $query);
        while ($row = mysqli_fetch_array($res)) {
            $nombre = $row["emp_nombre"];
            $apellido = $row["emp_apellido"];
            $cedula = $row["emp_cedula"];
            $usuario = $row["emp_usuario"];
            $clave = $row["emp_clave"];
        }
        ?>

        <form action="registroempleado.php" method="POST">
            <input type="text" name="nombre" placeholder='Nombre' value="<?php echo $nombre; ?>">
            <input type="text" name="apellido" placeholder='Apellido' value="<?php echo $apellido; ?>">
            <input type="number" name="cedula" placeholder='Cedula' value="<?php echo $cedula; ?>">
            <input type="text" name="usuario" placeholder='Usuario' value="<?php echo $usuario; ?>">
            <input type="text" name="clave" placeholder='Clave' value="<?php echo $clave; ?>">
            <input type="hidden" name="codigo" value="<?php echo $cod; ?>">
            <input type="submit" value="Modificar" name="modificar">
        </form>
    </div>
</body>
</html>
