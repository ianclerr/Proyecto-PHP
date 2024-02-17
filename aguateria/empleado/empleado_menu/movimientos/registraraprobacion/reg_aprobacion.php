<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="bidon.jpg" type="image/x-icon">
    <title>Registrar Aprobacion</title>
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
            max-width: 800px;
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
        <h2>Registrar Aprobacion</h2>
        
        <form method="POST">
        </form>
    
        <table>
            <tr>
                <th>Codigo</th>
                <th>Nombre:</th>
                <th>Fecha:</th>
                <th>Hora:</th>
                <th>Cedula:</th>
                <th>Estado</th>
                
            </tr>
            
            <?php
            include("conexion.php");
    

            if (!empty($_POST['estado'])) {
     
                $reservaCodigo = $_POST["codigo"];       

                echo $query = "UPDATE solicitud SET sol_estado=1 WHERE sol_codigo=$reservaCodigo";
                mysqli_query($conexion, $query);
            }

            $query = "SELECT * FROM solicitud WHERE sol_estado = 0";
            $res = mysqli_query($conexion, $query);

            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>" . $row["sol_codigo"] . "</td>";
                echo "<td>" . $row["sol_nombre"] . "</td>";
                echo "<td>" . $row["sol_fecha"] . "</td>";
                echo "<td>" . $row["sol_hora"] . "</td>";
                echo "<td>" . $row["sol_cedula"] . "</td>";
                echo "<td>";

                // Mostrar el estado como texto
                if ($row["sol_estado"] == 0) {
                    echo "Pendiente";
                } elseif ($row["sol_estado"] == 1) {
                    echo "En Proceso";
                } elseif ($row["sol_estado"] == 2) {
                    echo "Finalizado";
                }

                echo "</td>";
                echo "<td class='actions'>";

                echo "<form action='reg_aprobacion.php' method='POST'>";
                
                echo "<input type='hidden' name='codigo' value='" . $row["sol_codigo"] . "'>";
                echo "<input type='submit' value='Recibir' name='estado'>";
                
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <a href="https://aguateriaelbidon.com/empleado/empleado_menu/index.php" class="redirect-button">Volver</a>
    </div>
</body>
</html>
