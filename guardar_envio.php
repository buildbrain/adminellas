<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "envios";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$vendedor = $_POST['vendedor'];

// Insertar el envío en la base de datos
$sql = "INSERT INTO envios (nombre, cantidad, vendedor) VALUES ('$nombre', $cantidad, '$vendedor')";
if ($conn->query($sql) === TRUE) {
  echo "Envío guardado exitosamente.";
} else {
  echo "Error al guardar el envío: " . $conn->error;
}
header("Location: ver_envios.php");
exit();

$conn->close();
?>
