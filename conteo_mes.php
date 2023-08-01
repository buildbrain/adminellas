<!DOCTYPE html>
<html>
<head>
  <title>Conteo del Mes</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="#"><i class="fas fa-shipping-fast"></i> Sistema de Envíos</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="informe_caja.php"><i class="fas fa-chart-line"></i> Informe de Caja</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="subir_envio.php"><i class="fas fa-plus-circle"></i> Crear Envío</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ver_envios.php"><i class="fas fa-list"></i> Ver Envíos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="conteo_dia.php"><i class="fas fa-calendar-day"></i> Conteo del Día</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="conteo_mes.php"><i class="fas fa-calendar-alt"></i> Conteo del Mes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="insertar_caja.php"><i class="fas fa-cash-register"></i> Insertar Caja</a>
        </li>
      </ul>
    </div>
  </div>
</nav>/li>
      </ul>
    </div>
  </nav>


  <div class="container mt-4">
    <h1>Conteo del Mes</h1>

    <form method="GET" action="conteo_mes.php">
      <div class="form-group">
        <label for="mes">Seleccionar Mes:</label>
        <select class="form-control" id="mes" name="mes">
         
          <option value="6">Junio</option>
          <option value="7">julio</option>
          <option value="8">agosto</option>
          <option value="9">septiembre</option>
          <option value="10">octubre</option>
          <option value="11">noviembre</option>
          <option value="12">diciembre</option>
          <!-- Agrega las opciones para los otros meses -->
        </select>
      </div>

      <div class="form-group">
        <label for="anio">Seleccionar Año:</label>
        <input type="text" class="form-control" value=2023 id="anio" name="anio">
      </div>

      <button type="submit" class="btn btn-primary">Consultar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["mes"]) && isset($_GET["anio"])) {
      $mes = $_GET["mes"];
      $anio = $_GET["anio"];

      // Realizar la conexión a la base de datos
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "envios";

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
      }
      
      $sql = "SELECT vendedor, COUNT(*) AS total_envios, SUM(cantidad) AS monto_total FROM envios WHERE MONTH(fecha_creacion) = $mes AND YEAR(fecha_creacion) = $anio AND entregado = 1 GROUP BY vendedor";
      
      // Obtener el conteo de envíos por vendedor para el mes y año especificados
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo '
        <table class="table">
          <thead>
            <tr>
              <th>Vendedor</th>
              <th>Total Envíos</th>
              <th>Monto Total de Ventas</th>
            </tr>
          </thead>
          <tbody>';

        while ($row = $result->fetch_assoc()) {
          echo '
          <tr>
            <td>' . $row['vendedor'] . '</td>
            <td>' . $row['total_envios'] . '</td>
            <td>$' . $row['monto_total'] . '</td>
          </tr>';
        }

        echo '
          </tbody>
        </table>';
      } else {
        echo "No se encontraron envíos para el mes y año especificados.";
      }

      $conn->close();
    }
    ?>
  </div>
</body>
</html>
