<?php
require_once '../includes/db.php';
require_once '../includes/consultas.php';

session_start();

// Verificar que el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Registro de nuevo usuario
    $usuario = $_POST['username'];
    $email = $_POST['email'];
    $telefono = $_POST['broj'];
    $contraseña = $_POST['contraseña'];
    $confirm_contraseña = $_POST['confirm_contraseña'];
    $role = $_POST['role'];

    // Verificar que las contraseñas coinciden
    if ($contraseña === $confirm_contraseña) {
        // Verificar si el email ya está registrado
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Este email ya está registrado.";
            exit();
        }

        $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT); // Encriptar contraseña

        if (agregarUsuario($usuario, $email, $telefono, $contraseña_hash, $role)) {
            $_SESSION['message'] = "Usuario agregado correctamente.";
        } else {
            $_SESSION['message'] = "Error al agregar el usuario.";
        }

        // Redirigir a user_table.php después de la inserción
        header("Location: ../pages/user_table.php");
        exit();
    } else {
        $_SESSION['message'] = "Las contraseñas no coinciden.";
        header("Location: ../pages/user_table.php");
        exit();
    }
}

// Cerrar la conexión
$conn->close();
?>

