<!DOCTYPE html>
<html>
<head>
  <title>Ver Envíos</title>
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


<?php
// Establecer la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "envios");

// Verificar la conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Obtener todos los envíos de la base de datos
$sql = "SELECT * FROM envios ORDER BY fecha_creacion DESC LIMIT 15";
$resultado = $conexion->query($sql);
?>

<div class="container">
  <h2>Envíos Realizados</h2>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Fecha de Creación</th>
        <th>Estado de Entrega</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $resultado->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo $row['cantidad']; ?></td>
          <td><?php echo date("Y-m-d", strtotime($row['fecha_creacion'])); ?></td>
          <td>
            <?php if ($row['entregado']) { ?>
              <span class="badge badge-success">Entregado</span>
            <?php } else { ?>
              <span class="badge badge-danger">No Entregado</span>
            <?php } ?>
          </td>
          <td>
            <?php if (!$row['entregado']) { ?>
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pinModal-<?php echo $row['id']; ?>">
                Modificar Entrega
              </button>
            <?php } ?>
          </td>
        </tr>
        <!-- Modal para solicitud de PIN -->
        <div class="modal fade" id="pinModal-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="pinModalLabel-<?php echo $row['id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="pinModalLabel-<?php echo $row['id']; ?>">Ingrese el PIN de autorización</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="modificar_entrega.php" method="POST">
                  <input type="hidden" name="envio_id" value="<?php echo $row['id']; ?>">
                  <div class="form-group">
                    <label for="pin">PIN:</label>
                    <input type="password" class="form-control" id="pin" name="pin" placeholder="Ingrese el PIN" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </tbody>
  </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
