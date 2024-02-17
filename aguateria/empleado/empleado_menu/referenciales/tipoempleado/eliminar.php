<?php
$codigo = $_POST["codigo"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirmar Eliminación</title>
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
           
            margin: 20px auto;
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
        <?php echo "¿Está seguro de que desea eliminar el registro?"; ?>

        <form action="tipoempleado.php" method="POST">
            <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
            <input type="submit" name="eliminar" value="SÍ">
        </form>

        <form action="tipoempleado.php" method="POST">
            <input type="submit" value="NO">
        </form>
    </div>
</body>
</html>
