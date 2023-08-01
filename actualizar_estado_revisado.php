<?php
// Verificamos si recibimos el parámetro 'id' en la solicitud POST
if (isset($_POST['id'])) {
    $id_fila = $_POST['id'];

    // Aquí debes implementar la lógica para actualizar el estado revisado en tu base de datos
    // Puedes usar MySQLi, PDO o cualquier otra librería de conexión a la base de datos

    // Ejemplo usando MySQLi
    $conexion = new mysqli("localhost", "root", "", "envios");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para actualizar el estado revisado en la tabla
    $sql = "UPDATE resumen_caja SET estado_revisado = 1 WHERE id = '$id_fila'";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_fila);

    // Ejecutar la consulta y verificar si se realizó correctamente
    if ($stmt->execute()) {
        // Si la actualización fue exitosa, devolvemos una respuesta JSON indicando el éxito
        $response = array("success" => true);
    } else {
        // Si ocurrió un error, devolvemos una respuesta JSON indicando el fallo
        $response = array("success" => false);
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();

    // Devolver la respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si no se recibió el parámetro 'id', devolvemos una respuesta de error
    $response = array("success" => false);
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
