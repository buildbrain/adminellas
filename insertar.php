<?php
// Establecer la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "envios");

// Verificar la conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$fecha = $_POST['fecha'];
$dinero_caja = $_POST['dinero_caja'];
$deposito_manana = $_POST['deposito_manana'];
$venta_total_sin_envio = $_POST['venta_total_sin_envio'];
$venta_efectivo = $_POST['venta_efectivo'];
$venta_tarjeta = $_POST['venta_tarjeta'];
$total_recibir_tarjeta = $_POST['total_recibir_tarjeta'];
$ubicacion_local = $_POST['ubicacion_local'];

// Preparar la consulta SQL
$sql = "INSERT INTO resumen_caja (fecha, dinero_caja, deposito_manana, venta_total_sin_envio, venta_efectivo, venta_tarjeta, total_recibir_tarjeta, ubicacion_local) VALUES ('$fecha', $dinero_caja, $deposito_manana, $venta_total_sin_envio, $venta_efectivo, $venta_tarjeta, $total_recibir_tarjeta, '$ubicacion_local')";

if ($conexion->query($sql) === TRUE) {
  echo "Datos insertados correctamente.";
} else {
  echo "Error al insertar los datos: " . $conexion->error;
}

$conexion->close();
?>
