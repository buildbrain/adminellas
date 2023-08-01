<!DOCTYPE html>
<html>
<head>
  <title>Subir Envío</title>
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
</nav>

  
  <div class="container mt-4">
    <h1>Subir Envío</h1>
    <form action="guardar_envio.php" method="POST">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
      </div>
      
      <div class="form-group">
        <label for="cantidad">Cantidad a pagar:</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
      </div>
      
      <div class="form-group">
        <label for="vendedor">Vendedor:</label>
        <select class="form-control" id="vendedor" name="vendedor" required>
          <option value="Melvin">Melvin</option>
          <option value="Dayana">Dayana</option>
          <option value="Genesis">Genesis</option>
          <!-- Agrega más opciones de vendedores según sea necesario -->
        </select>
      </div>
      
      <button type="submit" class="btn btn-primary">Guardar Envío</button>
    </form>
  </div>
</body>
</html>
