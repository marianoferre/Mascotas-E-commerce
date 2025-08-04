<?php
header("Content-Type: application/json");
require_once '../includes/db.php'; // Archivo que contendrá la conexión a la base de datos

// Obtener los datos de la solicitud POST
$data = json_decode(file_get_contents("php://input"), true);
$productId = $data['id'] ?? null;

if ($productId) {
    // Preparar y ejecutar la consulta de eliminación
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar el producto"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "ID de producto no proporcionado"]);
}

$conn->close();
