<?php
session_start();
include '../includes/db.php';

if (isset($_POST['id'])) {
    $productoId = $_POST['id'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $arreglo = $_SESSION['carrito'];
    $encontro = false;
    $numero = 0;

    foreach ($arreglo as $index => $producto) {
        if ($producto['Id'] == $productoId) {
            $encontro = true;
            $numero = $index;
            break;
        }
    }

    if ($encontro) {
        $arreglo[$numero]['Cantidad'] += 1;
    } else {
        $stmt = $conn->prepare('SELECT nombre, precio, image_url FROM products WHERE id = ?');
        $stmt->bind_param('i', $productoId);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
        if ($fila) {
            $arreglonuevo = array(
                'Id' => $productoId,
                'Nombre' => $fila['nombre'],
                'Precio' => $fila['precio'],
                'Imagen' => $fila['image_url'],
                'Cantidad' => 1
            );
            $arreglo[] = $arreglonuevo;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
            exit;
        }
        $stmt->close();
    }

    $_SESSION['carrito'] = $arreglo;

    // Respuesta de éxito con el número de productos en el carrito
    echo json_encode(['status' => 'success', 'items_in_cart' => count($_SESSION['carrito'])]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'error en la consulta a la base de datos']);
}
?>


