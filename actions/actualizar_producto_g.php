<?php
session_start();
require_once '../includes/db.php'; // Archivo que contendrá la conexión a la base de datos

// Recibir datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$imagen = $_POST ['image_url'];
// Manejar la subida de imagen (si se proporciona una nueva)
//$imagen = $_FILES['imagen']['name'];
if ($imagen) {
    $target_dir = "../uploads/"; // Directorio donde se almacenarán las imágenes
    $target_file = $target_dir . basename($imagen);

    move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file);

    $sql = "UPDATE products SET nombre=?, categoria=?, descripcion=?, precio=?, stock=?, imagen=? WHERE id=?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssssi", $nombre, $categoria, $descripcion, $precio, $stock, $target_file, $id);
} else {
    // Si no se sube nueva imagen, no la actualizamos
    $sql = "UPDATE products SET nombre=?, categoria=?, descripcion=?, precio=?, stock=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $nombre, $categoria, $descripcion, $precio, $stock, $id);
}

// Ejecutar la consulta
if ($stmt->execute()) {
    $_SESSION['message'] = "Producto actualizado correctamente.";
} else {
    $_SESSION['message'] = "Error al actualizar el producto: " . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Redirigir de vuelta a la tabla de productos
header("Location: ../pages/product_table.php");
exit();
