<?php
// Obtener la fecha actual
$fecha_actual = date('Y-m-d');

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "envios");
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener el conteo de envíos realizados en el día
$sql = "SELECT COUNT(*) as total_envios, SUM(cantidad) as total_cantidad FROM envios WHERE DATE(fecha_creacion) = '$fecha_actual'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
  $row = $resultado->fetch_assoc();
  $total_envios = $row['total_envios'];
  $total_cantidad = $row['total_cantidad'];
} else {
  $total_envios = 0;
  $total_cantidad = 0;
}

$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Conteo del Día</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
</nav>

  <div class="container">
    <h1>Conteo del Día</h1>
    <p>Fecha: <?php echo $fecha_actual; ?></p>
    <p>Total de envíos realizados: <?php echo $total_envios; ?></p>
    <p>Total de cantidad sumada: <?php echo $total_cantidad; ?></p>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
