<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Mantenimiento</title>
    <link rel="icon" href="bidon.jpg" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        
        h2 {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
        }

        .container {
            width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        form {
            margin-top: 20px;
        }

        form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .actions {
            display: flex;
            justify-content: space-around;
        }
        .redirect-button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <br>
        <br>
        <h2>Registrar Mantenimiento</h2>
        
        <form method="POST">
        </form>
    
        <table>
            <tr>    
                <th>Codigo:</th>
                <th>Nombre:</th>
                <th>Apellido:</th>
                <th>Cedula:</th>
                <th>Telefono:</th>
                <th>Reclamo:</th>
                <th>Fecha:</th>
                <th>Hora:</th>
                <th>Estado:</th>
                
            </tr>
            
            <?php
            include("conexion.php");

            date_default_timezone_set('America/Asuncion');
            $nuevaFecha = date("Y-m-d H:i:s");
            $fechaActual = date('Y-m-d');

            if (!empty($_POST['estado'])) {
                $reservaCodigo = $_POST["codigo"];       

                echo $query = "UPDATE reclamo SET rec_estado=1 WHERE rec_codigo=$reservaCodigo";
                mysqli_query($conexion, $query);
            } elseif (!empty($_POST['estado2'])) {
                $reservaCodigo = $_POST["codigo"];       

                echo $query = "UPDATE reclamo SET rec_estado=2, rec_horaaprobada = '$nuevaFecha', rec_fechaaprobada ='$fechaActual' WHERE rec_codigo=$reservaCodigo";
                mysqli_query($conexion, $query);
            }

            $query = "SELECT * FROM reclamo WHERE rec_estado = 0 OR rec_estado = 1";
            $res = mysqli_query($conexion, $query);

            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>" . $row["rec_codigo"] . "</td>";
                echo "<td>" . $row["rec_nombre"] . "</td>";
                echo "<td>" . $row["rec_apellido"] . "</td>";
                echo "<td>" . $row["rec_cedula"] . "</td>";
                echo "<td>" . $row["rec_telefono"] . "</td>";
                echo "<td>" . $row["rec_reclamo"] . "</td>";
                echo "<td>" . $row["rec_fecha"] . "</td>";
                echo "<td>" . $row["rec_hora"] . "</td>";
                echo "<td>" . ($row["rec_estado"] == 0 ? "Pendiente" : "En Proceso") . "</td>";
                echo "<td class='actions'>";

                if ($row["rec_estado"] == 0) {
                    echo "<form action='reg_mantenimiento.php' method='POST'>";
                    echo "<input type='hidden' name='codigo' value='" . $row["rec_codigo"] . "'>";
                    echo "<input type='submit' value='Iniciar' name='estado'>";
                    echo "</form>";
                } elseif ($row["rec_estado"] == 1) {
                    echo "<form action='reg_mantenimiento.php' method='POST'>";
                    echo "<input type='hidden' name='codigo' value='" . $row["rec_codigo"] . "'>";
                    echo "<input type='button' value='Finalizado' onclick='confirmFinalizado(" . $row["rec_codigo"] . ")'>";
                    echo "</form>";
                } else {
                    // Estado 2, ya está finalizado
                    echo "Finalizado";
                }

                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="https://aguateriaelbidon.com/empleado/empleado_menu/index.php" class="redirect-button">Volver</a>

        <script>
            function confirmFinalizado(codigo) {
                var confirmacion = confirm("¿Estás seguro/a que ha finalizado?");
                if (confirmacion) {
                    // Aquí puedes agregar el código para cambiar a estado 2
                    document.querySelector('form').submit();
                }
            }
        </script>
    </div>
</body>
</html>
