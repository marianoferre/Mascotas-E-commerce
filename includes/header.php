<!-- header.php -->
<header>
    <nav class="navbar">
        <div class="logo">
            <a href="home.php">
                <img src="../uploads/Logo3.png" id="loguito" alt="PROTON S.A.">
            </a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="home.php" class="saludo">Hola, <?php echo htmlspecialchars($_SESSION['username']); ?>!</a>
            <?php else: ?>
                <a href="home.php">Mi E-commerce</a>
            <?php endif; ?>
        </div>
        <form action="searcher.php" method="POST" class="search-form">
            <input type="text" name="query" class="search-bar" placeholder="Buscar..." required>
            <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
        </form>
        <ul class="nav-links">
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                <li>
                    <a href="../pages/user_table.php">Usuarios</a>
                </li>
                <li>
                    <a href="../pages/product_table.php" class="dropdown-toggle">Productos</a>
                </li>
                <li><a onclick="CerrarSesion()">Logout</a></li>
            <?php else: ?>
                <div class="carrito-icono">
                    <a href="carrito.php">
                        <i class="fas fa-shopping-cart"></i>
                        <?php if (!empty($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
                            <!-- Punto rojo que solo aparece si hay productos en el carrito -->
                            <span class="punto-rojo"></span>
                        <?php endif; ?>
                    </a>
                    </li> <!-- Ícono de carrito -->
                </div>
                <li class="contacto"><a href="../pages/contact.php">Contacto</a></li>
                <li><a onclick="CerrarSesion()">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<script>
    function CerrarSesion() {
        window.location.href = "../actions/cerrar_sesion.php";
       }
</script>
