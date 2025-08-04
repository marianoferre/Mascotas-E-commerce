<?php
session_start();
require_once '../includes/db.php'; // Archivo que contendrá la conexión a la base de datos

// Validar y recibir datos del formulario
$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$role = $_POST['role'];

// Solo actualizar contraseña si se ingresó una nueva
$password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

// Construir consulta SQL de actualización
$sql = "UPDATE users SET username = '$username', email = '$email', telefono = '$telefono', role = '$role'";
if ($password) {
    $sql .= ", password = '$password'";
}
$sql .= " WHERE id = $id";

// Ejecutar consulta
if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Usuario actualizado con éxito.";
} else {
    $_SESSION['message'] = "Error al actualizar el usuario: " . $conn->error;
}

$conn->close();

// Redirigir de vuelta a user_table.php con mensaje de éxito
header("Location: ../pages/user_table.php");
exit();
?>
