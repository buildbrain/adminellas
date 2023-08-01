<?php
// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener el ID del envío y el PIN enviado por el formulario
  $envio_id = $_POST['envio_id'];
  $pin = $_POST['pin'];

  // Verificar el PIN
  if ($pin === '*') { // Cambiar '2030' por tu PIN real
    // Actualizar el estado de entrega del envío en la base de datos
    $conexion = new mysqli("localhost", "root", "", "envios");
    if ($conexion->connect_error) {
      die("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "UPDATE envios SET entregado = 1 WHERE id = $envio_id";
    if ($conexion->query($sql) === true) {
      // Redireccionar a la página de ver envíos
      header("Location: ver_envios.php");
      exit;
    } else {
      echo "Error al actualizar el estado de entrega: " . $conexion->error;
    }

    $conexion->close();
  } else {
    echo "PIN incorrecto";
  }
}
?>
