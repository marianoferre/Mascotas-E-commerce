<?php
// includes/consultas.php
require_once 'db.php'; // Incluir la conexión

function verificarUsuario($email) {
    global $conn;
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    return $stmt->get_result();
}

function registrarUsuario($usuario, $email, $telefono, $contraseña_hash) {
    global $conn;
    $query = "INSERT INTO users (username, email, telefono, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $usuario, $email, $telefono, $contraseña_hash);
    return $stmt->execute();
}

function agregarProducto($nombre, $categoria, $descripcion, $precio, $stock, $imagenUrl) {
    global $conn;

    // Crear la consulta SQL directamente
    $sql = "INSERT INTO products (nombre, categoria, descripcion, precio, stock, image_url) 
            VALUES ('$nombre', '$categoria', '$descripcion', $precio, $stock, '$imagenUrl')";

    // Ejecutar la consulta y verificar si se insertó correctamente
    if ($conn->query($sql) === TRUE) {
        return true; // Éxito
    } else {
        return false; // Fallo
    }
}

function agregarUsuario($usuario, $email, $telefono, $contraseña_hash, $role) {
    global $conn;

    // Crear la consulta SQL directamente
    $sql = "INSERT INTO users (username, email, telefono, password, role) 
            VALUES ('$usuario', '$email', '$telefono', '$contraseña_hash', '$role')";

    // Ejecutar la consulta y verificar si se insertó correctamente
    if ($conn->query($sql) === TRUE) {
        return true; // Éxito
    } else {
        return false; // Fallo
    }
}
?>
