<!DOCTYPE html>
<html>
<head>
  <title>Insertar Caja</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f7f7f7;
      color: #333;
    }

    h2 {
      margin-top: 20px;
      margin-bottom: 20px;
      text-align: center;
    }

    .container {
      margin-top: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn {
      margin-top: 10px;
    }

    .navbar {
      margin-bottom: 20px;
    }
  </style>
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
  <h2>Insertar Caja</h2>

  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
      <label for="fecha">Fecha (YYYY-MM-DD):</label>
      <input type="date" name="fecha" id="fecha" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="dinero_caja">Dinero en Caja:</label>
      <input type="number" step="0.01" name="dinero_caja" id="dinero_caja" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="deposito_manana">Depósito para Mañana:</label>
      <input type="number" step="0.01" name="deposito_manana" id="deposito_manana" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="venta_total_sin_envio">Venta Total sin Envío:</label>
      <input type="number" step="0.01" name="venta_total_sin_envio" id="venta_total_sin_envio" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="venta_efectivo">Venta en Efectivo:</label>
      <input type="number" step="0.01" name="venta_efectivo" id="venta_efectivo" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="venta_tarjeta">Venta en Tarjeta:</label>
      <input type="number" step="0.01" name="venta_tarjeta" id="venta_tarjeta" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="	ventas_tranferencia">	ventas_tranferencia:</label>
      <input type="number" name="ventas_tranferencia" id="ventas_tranferencia" class="form-control" required>
    </div>

    
    <div class="form-group">
      <label for="total_recibir_tarjeta">Total a Recibir en Tarjeta:</label>
      <input type="number" step="0.01" name="total_recibir_tarjeta" id="total_recibir_tarjeta" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="saldo_final">Saldo Final:</label>
      <input type="number" step="0.01" name="saldo_final" id="saldo_final" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="ubicacion_local">Ubicación Local:</label>
      <input type="text" name="ubicacion_local" id="ubicacion_local" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establecer la conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "envios");

    // Verificar la conexión
    if ($conexion->connect_error) {
      die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtener los valores del formulario
    $fecha = $_POST['fecha'];
    $dinero_caja = $_POST['dinero_caja'];
    $deposito_manana = $_POST['deposito_manana'];
    $venta_total_sin_envio = $_POST['venta_total_sin_envio'];
    $venta_efectivo = $_POST['venta_efectivo'];
    $venta_tarjeta = $_POST['venta_tarjeta'];
    $total_recibir_tarjeta = $_POST['total_recibir_tarjeta'];
    $saldo_final = $_POST['saldo_final'];
    $ubicacion_local = $_POST['ubicacion_local'];

    // Preparar la consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO resumen_caja (fecha, dinero_caja, deposito_manana, venta_total_sin_envio, venta_efectivo, venta_tarjeta, total_recibir_tarjeta, saldo_final, ubicacion_local) VALUES ('$fecha', $dinero_caja, $deposito_manana, $venta_total_sin_envio, $venta_efectivo, $venta_tarjeta, $total_recibir_tarjeta, $saldo_final, '$ubicacion_local')";

    if ($conexion->query($sql) === TRUE) {
      echo "<p class='text-success'>Registro insertado correctamente.</p>";
    } else {
      echo "<p class='text-danger'>Error al insertar el registro: " . $conexion->error . "</p>";
    }

    $conexion->close();
  }
  ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
