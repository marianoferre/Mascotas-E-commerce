<?php
session_start();

include '../includes/db.php';

// Consulta para obtener todos los productos
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/prueba.css">
</head>
<body>
   
    <?php include '../includes/header.php'; //incluye header global para todas las páginas que dependan de admin.php ?>
    
    <?php
// Mostrar mensaje si está configurado
        if (isset($_SESSION['message'])) {
            echo "<div id='message-box' class='message-box'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']); // Eliminar el mensaje de la sesión después de mostrarlo
        }
    ?>

    <section class="table-section">
        <div class="table-container">
            <h1 class="titulo-tabla">Gestión de Productos:</h1>
            <div class="table-header">
                <button class="add-product-button" title="Agregar Producto" id="addProductButton">+</button>
            </div>
            <table class="product-table" border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th> <!-- Nueva columna "Precio" -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr id="product-<?php echo $row['id']; ?>"> <!-- Cambia para agregar un id a la fila -->
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['precio']); ?></td>

                                <td class="action-buttons">
                                    <button class="btn-modificar" data-id="<?php echo $row['id']; ?>" onclick="location.href='product_form.php?id=<?php echo $row['id']; ?>'">Modificar</button>
                                    <button class="btn-eliminar" data-id="<?php echo $row['id']; ?>">Eliminar</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No hay productos disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
    
    <?php include('../includes/footer.php'); ?>
    <script src="../assets/js/add_product.js"></script>
    <script src="../assets/js/msg.js"></script>
    <script src="../assets/js/delete_product.js"></script>

</body>
</html>
