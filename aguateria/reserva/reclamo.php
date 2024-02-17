<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="bidon.jpg" type="image/x-icon">
    <title>Formulario de Reclamo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 50%;
            margin: 20px auto;
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

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #success-message {
            display: none;
            color: green;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulario de Reclamo</h2>
        <form id="reclamoForm" action="" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="rec_nombre" required>

            <label for="apellido">Apellido:</label>
            <input type="text" name="rec_apellido" required>

            <label for="cedula">Cédula:</label>
            <input type="text" name="rec_cedula" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="rec_telefono" required>

            <label for="reclamo">Reclamo:</label>
            <textarea name="rec_reclamo" required></textarea>

            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" required>

            <label for="hora">Hora:</label>
            <input type="time" name="hora" required>

            <input type="submit" value="Enviar Reclamo" onclick="showSuccessMessage()">
        </form>

        <div id="success-message">Su reclamo se ha enviado correctamente.</div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include("conexion.php");

            $nombre = $_POST["rec_nombre"];
            $apellido = $_POST["rec_apellido"];
            $cedula = $_POST["rec_cedula"];
            $telefono = $_POST["rec_telefono"];
            $fecha = $_POST["fecha"];
            $hora = $_POST["hora"];
            $reclamo = $_POST["rec_reclamo"];

            $query = "INSERT INTO reclamo (rec_nombre, rec_apellido, rec_cedula, rec_telefono, rec_fecha, rec_hora, rec_reclamo) 
                      VALUES ('$nombre', '$apellido', '$cedula', '$telefono', '$fecha', '$hora', '$reclamo')";

            mysqli_query($conexion, $query);
        }
        ?>

        <script>
            function showSuccessMessage() {
                document.getElementById("success-message").style.display = "block";
                setTimeout(function() {
                    document.getElementById("success-message").style.display = "none";
                }, 3000); // 3000 milisegundos = 3 segundos
            }
        </script>
    </div>
</body>
</html>
