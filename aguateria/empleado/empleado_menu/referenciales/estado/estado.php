<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['guardar'])) {
        $descripcion = $_POST["descripcion"];
        $query = "INSERT INTO estado (est_descripcion) VALUES ('$descripcion')";
        mysqli_query($conexion, $query);
    }

    if (!empty($_POST['eliminar'])) {
        $cod = $_POST["codigo"];
        $query = "DELETE FROM estado WHERE est_codigo = $cod";
        mysqli_query($conexion, $query);
    }

    if (!empty($_POST['modificar'])) {
        $cod = $_POST["codigo"];
        $descripcion = $_POST["descripcion"];
        $query = "UPDATE estado SET est_descripcion = '$descripcion' WHERE est_codigo = $cod";
        mysqli_query($conexion, $query);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Estados</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        /* Formulario de carga de estados */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Tabla de estados */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        table th, table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
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
        <h2>Formulario de Carga de Estados</h2>
        <form method="POST">
            <input type="text" name="descripcion" placeholder="Descripción"><br>
            <input type="submit" value="Guardar" name="guardar">
        </form>

        <?php
        // Mostrar el contenido de la tabla
        $query = "SELECT * FROM estado";
        $res = mysqli_query($conexion, $query);
        echo "<table><tr><th>Código</th><th>Descripción</th></tr>";

        while ($row = mysqli_fetch_array($res)) {
            echo "<tr><td>";
            echo $codigo = $row["est_codigo"];
            echo "</td><td>";
            echo $row["est_descripcion"];
            echo "</td><td>";

            echo "<form action='eliminar.php' method='POST'>";
            echo "<input type='hidden' name='codigo' value='$codigo'>";
            echo "<input type='submit' value='Eliminar' name='eliminar'>";
            echo "</form>";

            echo "<form method='POST'>";
            echo "<input type='hidden' name='codigo' value='$codigo'>";
            echo "<input type='text' name='descripcion' placeholder='Descripción'>";
            echo "<input type='submit' value='Modificar' name='modificar'>";
            echo "</form>";

            echo "</td></tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>
</html>
