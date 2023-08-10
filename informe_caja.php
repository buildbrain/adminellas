<!DOCTYPE html>
<html>
<head>
  <title>Informe de Caja</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      background-color: #f7f7f7;
      color: #333;
      font-family: Arial, sans-serif;
    }

    h2 {
      margin-top: 20px;
      margin-bottom: 20px;
      text-align: center;
    }

    .navbar {
      background-color: pink;
      border-bottom: 1px solid #ccc;
    }

    .navbar-brand {
      font-weight: bold;
      color: #333;
    }

    .navbar-toggler {
      border: none;
      outline: none;
    }

    .navbar-nav .nav-link {
      color: #333;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
    }

    .table {
      margin-bottom: 30px;
      background-color: #fff;
    }

    .table th {
      background-color: pink;
      color: #000;
      font-weight: bold;
    }

    .table td,
    .table th {
      text-align: center;
      vertical-align: middle;
      border: 1px solid pink;
    }

    .table td {
      background-color: #f7f7f7;
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
  <h2>Informe de Caja</h2>
  <?php
require 'conexion.php';


  $sql = "SELECT id, DATE_FORMAT(fecha, '%d %M') AS fecha_formato, dinero_caja, deposito_manana, venta_total_sin_envio, venta_efectivo, venta_tarjeta, (venta_tarjeta - venta_tarjeta * 0.035) AS total_recibir_tarjeta, saldo_final, ubicacion_local, estado_revisado FROM resumen_caja ORDER BY fecha DESC";

  $resultado = $conexion->query($sql);
  if ($resultado->num_rows > 0) {
    ?>
    <table class="table table-responsive">
      <thead>
        <tr>
          <th>Día de Cierre</th>
          <th>Dinero en Caja (HNL)</th>
          <th>Depósito para Mañana (HNL)</th>
          <th>Venta Total sin Envío (HNL)</th>
          <th>Venta en Efectivo (HNL)</th>
          <th>Venta en Tarjeta (HNL)</th>
          <th>Total a Recibir en Tarjeta (HNL)</th>
          <th>Ubicación Local</th>
          <th>Estado Revisado</th>
        </tr>
      </thead>
      <!-- ... (Código HTML previo) ... -->

      <tbody>
  <?php
  while ($row = $resultado->fetch_assoc()) {
    $estado_revisado = $row['estado_revisado'];
    $fila_color = $estado_revisado === 'revisado' ? 'table-success' : ''; // Clase CSS para filas revisadas
    $id_fila = $row['id']; // Obtener el valor del id de la fila

    ?>
    <tr class="<?php echo $fila_color; ?>">
      <td><?php echo $row['fecha_formato']; ?></td>
      <td><?php echo intval($row['dinero_caja']); ?></td>
      <td><?php echo intval($row['deposito_manana']); ?></td>
      <td><?php echo intval($row['venta_total_sin_envio']); ?></td>
      <td><?php echo intval($row['venta_efectivo']); ?></td>
      <td><?php echo intval($row['venta_tarjeta']); ?></td>
      <td><?php echo intval($row['total_recibir_tarjeta']); ?></td>
      <td><?php echo $row['ubicacion_local']; ?></td>
      <td>
        <?php if ($estado_revisado == 1) : ?>
          <button type="button" class="btn btn-success">Revisado</button>
        <?php else : ?>
          <button type="button" class="btn btn-primary btn-marcar-revisado" data-id="<?php echo $id_fila; ?>" data-estado="<?php echo $estado_revisado; ?>">Marcar como Revisado</button>
        <?php endif; ?>
      </td>
    </tr>
    <?php
  }
  ?>
</tbody>


<!-- ... (Resto del código HTML) ... -->

    </table>
    <?php
  } else {
    echo "No se encontraron datos en el informe de caja.";
  }

  $conexion->close();
  ?>
</div>

<!-- Agregar el modal para solicitar la contraseña -->
<div class="modal fade" id="modalContraseña" tabindex="-1" role="dialog" aria-labelledby="modalContraseñaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalContraseñaLabel">Ingresar Contraseña para Marcar como Revisado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formContraseña">
          <div class="form-group">
            <label for="inputContraseña">Contraseña:</label>
            <input type="password" class="form-control" id="inputContraseña" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnConfirmar">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  // Variables para almacenar el id de la fila y el estado revisado
  let idFila;
  let estadoRevisado;

  // Función para abrir el modal y almacenar el id de la fila y el estado revisado
  function abrirModal(id, revisado) {
    idFila = id;
    estadoRevisado = revisado;
    $('#modalContraseña').modal('show');
  }

  // Función para enviar la contraseña y realizar la acción si es correcta
  function enviarContraseña() {
    const contraseñaIngresada = document.getElementById('inputContraseña').value;
    // Aquí debes verificar si la contraseña ingresada es correcta, por ejemplo, comparándola con una contraseña almacenada en la base de datos o en una variable en el servidor.
    // Por simplicidad, en este ejemplo asumimos que la contraseña correcta es "mi_contraseña". En un caso real, esta lógica debe estar en el servidor.
    const contraseñaCorrecta = '*';

    if (contraseñaIngresada === contraseñaCorrecta) {
      // Si la contraseña es correcta, marcar como revisado
      marcarComoRevisado();
    } else {
      // Si la contraseña es incorrecta, mostrar un mensaje de error
      alert('Contraseña incorrecta. Inténtalo de nuevo.');
      document.getElementById('inputContraseña').value = '';
    }
  }

  // Función para marcar la fila como revisado
  function marcarComoRevisado() {
    // Crear una instancia de XMLHttpRequest
    const xhr = new XMLHttpRequest();

    // Configurar la solicitud
    xhr.open('POST', 'actualizar_estado_revisado.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Configurar el callback de la respuesta
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Actualización exitosa, cambiar el estado visual del botón y fila
          document.getElementById(`btnRevisado_${idFila}`).innerHTML = 'Revisado';
          document.getElementById(`btnRevisado_${idFila}`).classList.remove('btn-primary');
          document.getElementById(`btnRevisado_${idFila}`).classList.add('btn-success');
          document.getElementById(`btnRevisado_${idFila}`).disabled = true;
          document.getElementById(`fila_${idFila}`).classList.add('table-success');
          $('#modalContraseña').modal('hide');

          
        } else {
          // Error al actualizar, muestra un mensaje de error si lo deseas
          console.log('Error al actualizar el estado revisado.');
        }

      }
    };

    // Enviar la solicitud con el id de la fila
    xhr.send(`id=${encodeURIComponent(idFila)}`);
    setTimeout(function() {
            location.reload();
          }, 100);
  }

  // Evento al hacer clic en el botón "Marcar como Revisado"
  document.addEventListener('DOMContentLoaded', function() {
    const botonesMarcarRevisado = document.querySelectorAll('.btn-marcar-revisado');

    botonesMarcarRevisado.forEach(boton => {
      boton.addEventListener('click', function() {
        const idFila = boton.dataset.id;
        const estadoRevisado = boton.dataset.estado;

        if (estadoRevisado !== 'revisado') {
          abrirModal(idFila, estadoRevisado);
        }
      });
    });

    // Evento al hacer clic en el botón "Confirmar" del modal
    document.getElementById('btnConfirmar').addEventListener('click', enviarContraseña);
  });
</script>

</body>
</html>
