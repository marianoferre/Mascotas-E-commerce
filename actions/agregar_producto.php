<?php
require_once '../includes/db.php';
require_once '../includes/consultas.php';
// Iniciar la sesión para almacenar mensajes
session_start();

// Verificar que el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    
    // Validar campos requeridos
    if (empty($nombre) || empty($categoria) || empty($descripcion) || $precio <= 0 || $stock < 0) {
        $_SESSION['message'] = "Todos los campos son requeridos y deben ser válidos.";
        header("Location: ../pages/product_table.php");
        exit;
    }
    
    // Manejo de la imagen subida
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = $_FILES['imagen'];
        $nombreImagen = time() . "_" . basename($imagen["name"]);
        $rutaDestino = "../uploads/" . $nombreImagen;

        // Mover la imagen a la carpeta de destino
        if (move_uploaded_file($imagen["tmp_name"], $rutaDestino)) {
            $imagenUrl = $rutaDestino; // Guardar la ruta en la base de datos
        } else {
            $_SESSION['message'] = "Error al subir la imagen.";
            header("Location: ../pages/product_table.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "No se subió ninguna imagen o hubo un error.";
        header("Location: ../pages/product_table.php");
        exit;
    }

        if (agregarProducto($nombre, $categoria, $descripcion, $precio, $stock, $imagenUrl)) {
        $_SESSION['message'] = "Producto agregado correctamente.";
    } else {
        $_SESSION['message'] = "Error al agregar el producto.";
    }

    // Redirigir a ./pages/product_table.php después de la inserción
    header("Location: ../pages/product_table.php");
    exit;
}


// Cerrar la conexión
$conn->close();
?>

