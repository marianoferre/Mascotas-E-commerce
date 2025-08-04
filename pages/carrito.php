<?php
session_start();
include '../includes/db.php';

// Comprobar si el carrito existe y si hay un ID de producto
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_GET['id'])) {
    $productoId = $_GET['id'];
    $arreglo = $_SESSION['carrito'];
    $encontro = false;
    $numero = 0;

   
    foreach ($arreglo as $index => $producto) {
        if ($producto['Id'] == $productoId) {
            $encontro = true;
            $numero = $index;
            break;
        }
    };

    if ($encontro) {
       
        $arreglo[$numero]['Cantidad'] += 1;
    } else {
        // Consultar el producto solo si no está en el carrito
        $stmt = $conn->prepare('SELECT nombre, precio, image_url FROM products WHERE id = ?');
        $stmt->bind_param('i', $productoId);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
        
        // Verificar si se obtuvo un resultado antes de agregar
        if ($fila) {
            $arreglonuevo = array(
                'Id' => $productoId,
                'Nombre' => $fila['nombre'],
                'Precio' => $fila['precio'],
                'Imagen' => $fila['image_url'],
                'Cantidad' => 1
            );
            $arreglo[] = $arreglonuevo;
        }
        $stmt->close();
    }

    // Actualizar el carrito en la sesión
    $_SESSION['carrito'] = $arreglo;
};
?>

<<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/carrito.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Carrito de Compras</title>
</head>
<body>
    
    <?php include('../includes/header.php'); ?>

    <h1>Carrito de Compras</h1>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalProductos = 0;
            $totalPagar = 0;

            if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
                foreach ($_SESSION['carrito'] as $producto) {
                    $subtotal = $producto['Precio'] * $producto['Cantidad'];
                    $totalProductos += $producto['Cantidad'];
                    $totalPagar += $subtotal;
            ?>
            <tr>
                <td><img src="<?php echo htmlspecialchars($producto['Imagen']); ?>" alt="Imagen del producto" width="50"?></td>
                <td><?php echo htmlspecialchars($producto['Nombre']); ?></td>
                <td class="cantidad">
                    <button onclick="cambiarCantidad(<?php echo $producto['Id']; ?>, -1)">-</button>
                    <input type="text" value="<?php echo htmlspecialchars($producto['Cantidad']); ?>" readonly>
                    <button onclick="cambiarCantidad(<?php echo $producto['Id']; ?>, 1)">+</button>
                </td>
                <td><?php echo number_format($producto['Precio'], 2); ?></td>
                <td><?php echo number_format($subtotal, 2); ?></td>
                <td><button class="btneliminar" data-id="<?php echo $producto['Id']; ?>">X</button></td>
     
            </tr>
            <?php } } else { ?>
            <tr>
                <td colspan="6" style="text-align:center;">No hay productos agregados.</td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3">Total de Productos:</td>
                <td><?php echo $totalProductos; ?></td>
                <td colspan="2">Total a Pagar: $<?php echo number_format($totalPagar, 2); ?></td>
            </tr>
        </tfoot>
    </table>
    
    
    <button class="btn-volver" onclick="window.location.href='home.php'">Volver</button>

    <form action="recibo.php" method="POST" target="_blank">

    <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['user_id']; ?>">
    <div class="botonera">
    <button class="btn-vaciar" onclick="vaciarCarrito()" <?php echo (count($_SESSION['carrito']) === 0) ? 'disabled' : ''; ?>>Vaciar Carrito</button>

    <button class="btn-finalizar" 
            <?php echo (count($_SESSION['carrito']) === 0) ? 'disabled' : ''; ?>
            onclick="return confirm('¿Estás seguro de que deseas finalizar la compra?');">
        Finalizar Compra
    </button>
</div>


</form>

    <script>
        // Función para cambiar la cantidad de un producto
        function cambiarCantidad(id, sum) {
            // Redirigir con un cambio de cantidad según el sum
            window.location.href = `../actions/actualizar_producto.php?id=${id}&sum=${sum}`;
        }

        // Función para vaciar el carrito
        function vaciarCarrito() {
            if (confirm("¿Deseas vaciar el carrito?")) {
                window.location.href = "../actions/vaciar_carrito.php";
            }
        }

// funcior para finalizar compra
        function finalizarCompra() {
            if (confirm("¿Esta seguro de que quiere finalizar la compra?")) {
                window.location.href = "../actions/finalizar_compra.php";
            }
        }

        // Manejar la eliminación de productos individuales
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btneliminar").forEach(function(boton) {
                boton.addEventListener("click", function(event) {
                    event.preventDefault();
                    const id = boton.getAttribute("data-id");
                    if (confirm("¿Deseas eliminar este producto del carrito?")) {
                        window.location.href = `../actions/eliminar_producto.php?id=${id}`;
                    }
                });
            });
        });
    </script>
    <?php include('../includes/footer.php'); ?>
</body>

</html>

