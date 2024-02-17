<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="bidon.jpg" type="image/x-icon">
  <title>Aguateria El Bidon</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;
    }

    .container {
      background-color: #fff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 6px;
      color: #007bff; /* Tono de agua - azul */
    }

    input[type="text"],
    input[type="date"],
    input[type="time"],
    input[type="number"],
    .btn {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      background-color: #f5f5f5; /* Color de fondo - gris claro */
      color: #333; /* Color del texto - gris oscuro */
    }

    .btn {
      background-color: #007bff; /* Tono de agua - azul */
      color: #fff;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-bottom: 10px;
      display: inline-block;
    }

    .btn:hover {
      background-color: #0056b3; /* Tono de agua - azul más oscuro */
    }

    .message {
      background: #4caf50;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      margin-top: 20px;
      display: none;
    }
  </style>
</head>
<body>
  <?php
    include("conexion.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['guardar'])) {
            $nombre = $_POST["sol_nombre"];
            $fecha = $_POST["sol_fecha"];
            $hora = $_POST["sol_hora"];
            $cedula = $_POST["sol_cedula"];

            $query = "INSERT INTO solicitud (sol_nombre, sol_fecha, sol_hora, sol_cedula, sol_estado) VALUES ('$nombre', '$fecha', '$hora', '$cedula', 0)";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $nombre, $fecha, $hora, $cedula);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
        } 
    }
  ?>

  <div class="container">
    <h2>Aguateria El Bidon</h2>
    <form method="POST" id="solicitudForm">
      <div class="form-group">
        <label>Nombre y Apellido:</label>
        <input type="text" name="sol_nombre" value="" required>
      </div>
      <div class="form-group">
        <label>Fecha de la solicitud:</label>
        <input type="date" name="sol_fecha" value="" required>
      </div>
      <div class="form-group">
        <label>Hora De La Solicitud:</label>
        <input type="time" name="sol_hora" value="" required>
      </div>
      <div class="form-group">
        <label>Cedula:</label>
        <input type="text" name="sol_cedula" value="" required>
      </div>
      <button type="submit" name="guardar" class="btn">Guardar Solicitud</button>
    </form>
    <div class="message" id="message">Solicitud guardada exitosamente</div>

    <!-- Botón Nuevo -->
    <a href="https://aguateriaelbidon.com/solicitud/solicitud.php" class="btn">Nuevo</a>

    <!-- Botón Reclamo -->
    <a href="reclamo.php" class="btn">Reclamo</a>
  </div>

  <script>

      var form = document.getElementById('solicitudForm');
      var message = document.getElementById('message');

      form.addEventListener('submit', function(event) {
        message.style.display = 'block';
        setTimeout(function() {
          message.style.display = 'none';
        }, 3000);
      });
  </script>
</body>
</html>
