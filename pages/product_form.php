<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Administrador</title>
    <link rel="stylesheet" href="../assets/css/prueba.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php session_start(); ?>     
    <?php include '../includes/header.php'; ?>

    <?php
    // Verificar si se está editando un producto
    $edit_mode = false;
    $product_data = [
        'id' => '',
        'nombre' => '',
        'categoria' => '',
        'descripcion' => '',
        'precio' => '',
        'stock' => '',
        'imagen' => ''
    ];

    if (isset($_GET['id'])) {
        $edit_mode = true;
        $product_id = intval($_GET['id']);
        
        include'../includes/db.php';
        
        // Obtener datos del producto
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $product_data = $result->fetch_assoc();
        }

        $conn->close();
    }
    ?>

    <!-- Formulario de alta o modificación de producto -->
    <section class="form-section">
        <form class="product-form" action="../actions/<?php echo $edit_mode ? 'actualizar_producto_g.php' : 'agregar_producto.php'; ?>" method="POST" enctype="multipart/form-data">
            <h2><?php echo $edit_mode ? 'Modificar Producto' : 'Agregar Producto'; ?></h2>
            <label class="id-del-producto" for="id"></label>
            <input class="id-del-producto" type="text" id="id" name="id" value="<?php echo $product_data['id']; ?>" readonly required>

            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $product_data['nombre']; ?>" required>

            <label for="categoria">Categoría:</label>
            <input type="text" id="categoria" name="categoria" value="<?php echo $product_data['categoria']; ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $product_data['descripcion']; ?></textarea>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $product_data['precio']; ?>" step="0.01" required>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" value="<?php echo $product_data['stock']; ?>" required>

            <label for="imagen">Subir imagen del producto:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">

            <button type="submit" class="btn-submit"><?php echo $edit_mode ? 'Actualizar Producto' : 'Agregar Producto'; ?></button>
        </form>
    </section>

    <?php include('../includes/footer.php'); ?>

</body>
</html>
