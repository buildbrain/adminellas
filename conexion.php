<?php
// Determina si estás en un entorno local o en producción
$local = ($_SERVER['SERVER_NAME'] === 'localhost');

// Configuración de la base de datos para entorno local
    $servername = "localhost";
    $username = "admi_ellass";
    $password = "Daymel23";
    $dbname = "admi_ellass";

// Intentar conectar a la base de datos
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay un error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa a la base de datos.";

?>
