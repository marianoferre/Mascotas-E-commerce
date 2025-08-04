<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>MySQL</title>
<link rel="stylesheet" href="../assets/css/prueba.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
<section>
    <?php
        session_start();
        include('../includes/db.php');
        include('../includes/header.php');

        // Verificar si 'query' está definido en POST
        $buscar = isset($_POST['query']) ? $_POST['query'] : '';

        // Evitar inyecciones SQL utilizando mysqli_real_escape_string
        $buscar = mysqli_real_escape_string($conn, $buscar);

        // Ejecutar la consulta
        $consulta = mysqli_query($conn, "SELECT * FROM products WHERE nombre LIKE '%$buscar%'");
    ?>
    <article class="busqueda">
        <p>Cantidad de Resultados: 
        <?php
            $nros = mysqli_num_rows($consulta);
            echo $nros;
        ?>
        </p>
        

        <?php
            // Mostrar cada producto con sus detalles completos
            while($resultados = mysqli_fetch_array($consulta)) {
                echo '<div class="product-cardd">';
                echo '<div class="price-tagg">$' . htmlspecialchars($resultados["precio"]) . '</div>';
                echo '<img src="../uploads/' . htmlspecialchars($resultados["image_url"]) . '" alt="' . htmlspecialchars($resultados["nombre"]) . '">';
                echo '<h3>' . htmlspecialchars($resultados["nombre"]) . '</h3>';
                echo '<p>' . htmlspecialchars($resultados["descripcion"]) . '</p>';
                echo '</div>';
                echo '<hr/>';
            }

            // Liberar los resultados y cerrar la conexión
            mysqli_free_result($consulta);
            mysqli_close($conn);
        ?>
    </article>
</section>
<?php include('../includes/footer.php'); ?>

</body>
</html>
