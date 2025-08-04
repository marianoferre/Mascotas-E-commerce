<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=login" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital@1&family=Homemade+Apple&family=Knewave&family=Lora:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/index2.css">
    <title>Landing Page - E-commerce de Mascotas</title>
   

    <!-- Bootstrap CSS para el carrusel -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>

    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="../uploads/Logo3.png" alt="Logo de la Empresa">
            </div>
            <ul class="nav-links">
              
                <li><a href="contact.php">Contáctanos</a></li>
            </ul>
        </nav>
    </header>

    <!-- Imagen de Bienvenida -->
    <section class="welcome">
        <img src="../uploads/header.jpg" alt="Banner de Bienvenida">
        <div class="welcome-text">
            <h2>Tu mascota, nuestra prioridad</h2>
            <p></p>
            <a href="./login.php" class="btn">Ingresar</a>
        </div>
    </section>

    <!-- Noticias y Promociones -->
    <section class="news">
                <div class="promociones">
                    <img src="../uploads/carne.jpg" alt="promocion">
                </div>
            <!-- Agrega noticias o promociones según necesites -->
            <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  </div>
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../uploads/premios.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../uploads/publicidad.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../uploads/publi.jpg" class="d-block w-100" alt="...">
                </div>
                </div>
            
            </div>
        
    </section>
    <section class="iconos">
        <div class="icon">
            <img src="../uploads/icon_dog-food.png" alt="Comida para perros">
            <p>Alimentos para perros y gatos</p>
        </div>
        <div class="icon">
            <img src="../uploads/icon_dog-toy.png" alt="Juguetes para perros">
            <p>Juguetes </p>
        </div>
        <div class="icon">
            <img src="../uploads/icon_pet-collar.png" alt="Collares para mascotas">
            <p>Collares y Correas</p>
        </div>
        <div class="icon">
            <img src="../uploads/icon_limpieza.png" alt="Productos de limpieza">
            <p>Productos de higiene</p>
        </div>
        
    </section>
    
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
    <p>&copy; 2024 - E-commerce de Insumos para Mascotas. Todos los derechos reservados.</p>
</footer>

</html>
