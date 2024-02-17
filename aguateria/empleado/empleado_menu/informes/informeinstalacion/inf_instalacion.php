<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="bidon.jpg" type="image/x-icon">
    <title>Informe Instalacion</title>
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

        form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form select {
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
        <h2>Informe Instalacion</h2>

        <!-- Formulario de búsqueda por fecha y estado -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fecha">Buscar por Fecha:</label>
            <input type="date" id="fecha" name="fecha">
            <label for="estado">Filtrar por Estado:</label>
            <select id="estado" name="estado">
            <option value="" selected disabled>Selecciona un Estado</option>
                <option value="1">En Proceso</option>
                <option value="2">Finalizado</option>
                <!-- Agrega aquí más opciones según tus estados -->
            </select>
            <button type="submit" name="buscar">Buscar</button>
        </form>

        <table>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Cedula</th>
                <th>Estado</th>
            </tr>

            <?php
            // Incluye el archivo de conexión a la base de datos.
            include("conexion.php");

            // Manejo de la búsqueda por fecha y/o estado
            if(isset($_POST['buscar'])){
                $whereClause = [];

                if(!empty($_POST['fecha'])){
                    $fechaBuscada = $_POST['fecha'];
                    $whereClause[] = "sol_fecha = '$fechaBuscada'";
                }

                if(isset($_POST['estado'])){
                    $estadoBuscado = $_POST['estado'];
                    $whereClause[] = "sol_estado = '$estadoBuscado'";
                }

                // Construye la consulta con el filtro
                $where = implode(" AND ", $whereClause);

                $query = "SELECT sol_codigo, sol_nombre, sol_fecha, sol_hora, sol_cedula, sol_estado
                          FROM solicitud";

                if(!empty($where)){
                    $query .= " WHERE " . $where;
                }
            } else {
                // Consulta para obtener todas las solicitudes sin filtro de fecha y estado
                $query = "SELECT sol_codigo, sol_nombre, sol_fecha, sol_hora, sol_cedula, sol_estado
                          FROM solicitud";
            }

            $res = mysqli_query($conexion, $query);

            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>" . $row["sol_codigo"] . "</td>";
                echo "<td>" . $row["sol_nombre"] . "</td>";
                echo "<td>" . $row["sol_fecha"] . "</td>";
                echo "<td>" . $row["sol_hora"] . "</td>";
                echo "<td>" . $row["sol_cedula"] . "</td>";
                echo "<td>";

                // Mostrar "En Proceso" o "Finalizado" en lugar del estado "1" o "2"
                if ($row["sol_estado"] == 1) {
                    echo "En Proceso";
                } elseif ($row["sol_estado"] == 2) {
                    echo "Finalizado";
                }

                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="https://aguateriaelbidon.com/empleado/empleado_menu/index.php" class="redirect-button">Volver</a>
    </div>
</body>
</html>
