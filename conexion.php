<?php
// Determina si estás en un entorno local o en producción
$local = ($_SERVER['SERVER_NAME'] === 'localhost');

// Configuración de la base de datos para entorno local
if (!$local) {
    $servername = "localhost";
    $username = "admi_ellass";
    $password = "Daymel23";
    $dbname = "admi_ellass";
} else { // Configuración de la base de datos para producción
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "envios";
}

// Intentar conectar a la base de datos
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay un error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa a la base de datos.";

// Aquí puedes realizar tus consultas y operaciones en la base de datos

// Finalizar la conexión
?>
