<?php
require_once '../includes/db.php'; // Archivo que contendrá la conexión a la base de datos

// Obtener el contenido JSON enviado desde el cliente
$data = json_decode(file_get_contents("php://input"), true);
$userId = $data['id'] ?? null;

$response = ['success' => false];

if ($userId) {
    // Preparar la consulta de eliminación
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    // Ejecutar y verificar si se eliminó correctamente
    if ($stmt->execute()) {
        $response['success'] = true;
    }

    $stmt->close();
}

$conn->close();

// Retornar la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
