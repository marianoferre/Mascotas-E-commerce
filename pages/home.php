<?php
require_once '../includes/db.php';

// Consulta para obtener todos los productos
$sql = "SELECT * FROM products order by id DESC";
$result = $conn->query($sql) or die ($conn -> error);
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
    <?php    
    session_start();
    include '../includes/header.php'; //incluye header global para todas las páginas que dependan de home.php
    ?>
<section class="products-section">
    <?php
    if ($result->num_rows > 0) {
        // Salida de cada fila
        while($row = $result->fetch_assoc()) {
            $productoStock = $row["stock"];
            echo '<div class="product-card">';
            echo '<div class="price-tag">$' . htmlspecialchars($row["precio"]) . '</div>';
            echo '<img src="../uploads/' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["nombre"]) . '">';
            echo '<h3>' . htmlspecialchars($row["nombre"]) . '</h3>';
            echo '<p>' . htmlspecialchars($row["descripcion"]) . '</p>';
            
            // Agregar botón de "Agregar al carrito"
            // Verificar el stock para mostrar el botón o mensaje de agotado
            if ($productoStock > 0) {
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'subscriber'){
                echo '<button onclick="agregarAlCarrito(' . htmlspecialchars($row["id"]) . ')" class="agregar-al-carrito">Agregar al carrito</button>';
                // echo '<a href="./carrito.php?id=' . urlencode($row["id"]) . '" class="agregar-al-carrito">Agregar al carrito</a>';
                }
            } else {
            
            // Si no hay stock, mostramos el mensaje de "Agotado"
            echo '<p class="agotado" style="margin: 10px; color: #c2002a; font-size: 1.5rem;" >Agotado</p>';
            }
                
            echo '</div>';
        }
    } else {
        echo '<p>No hay productos disponibles.</p>';
    }
    ?>
</section>

<?php include('../includes/footer.php'); ?>

<script src="../assets/js/agregar_al_carrito.js"></script>

</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>

