<?php 

session_start();

include_once '../includes/db.php';

if (isset($_GET['id']) && isset($_GET['sum'])) {
    $id = $_GET['id'];  
    $sum = $_GET['sum'];
} else {
    die("Error: ID del producto no especificado");
}

// Consultar el producto
$sql = "SELECT * FROM products WHERE id = $id";
$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $producto = mysqli_fetch_assoc($resultado);
} else {
    echo "Error: producto no encontrado";
    // Sería ideal la redirección a una página de error
}

// Verificar si hay un carrito en la sesión
if (isset($_SESSION['carrito'])) {
    $carrito = $_SESSION['carrito'];
    $encontrado = false;
    $indiceProducto = null;

    foreach ($carrito as $indice => $producto) {
        if ($producto['Id'] == $id) { 
            $encontrado = true;
            $indiceProducto = $indice; // Guardamos el índice del producto encontrado
            break; // Salimos del bucle porque ya encontramos el producto
        }
    }

    if ($encontrado) {
        // Producto encontrado en el carrito, actualizar la cantidad
        if ($sum == 1) {
            // Incrementar la cantidad
            $carrito[$indiceProducto]['Cantidad'] += 1;
        } elseif ($sum == -1) {
            // Decrementar la cantidad
            if ($carrito[$indiceProducto]['Cantidad'] > 1) {
                $carrito[$indiceProducto]['Cantidad'] -= 1;
            } else {
                // Si la cantidad es 1, podríamos optar por eliminar el producto
                unset($carrito[$indiceProducto]);
            }
        }

        // Actualizar el carrito en la sesión
        $_SESSION['carrito'] = array_values($carrito); // Reindexar el array
    } else {
        echo "El producto no está en el carrito.";
    }
} else {
    echo "No hay productos en el carrito.";
}

// Redirigir al carrito después de actualizar
header("Location: ../pages/carrito.php");
exit;

?>
