<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Sign Up</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <?php
    session_start();

    // Mostrar mensaje si está configurado
    if (isset($_SESSION['message'])) {
        echo "<div id='message-box' class='message-box'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Eliminar el mensaje de la sesión después de mostrarlo
    }
    ?>
    <div class="main-position">
        <div class="main">
            
            <input type="checkbox" id="click" aria-hidden="true">
            <form id="registrarme" class="registrarme" method="POST" action="../actions/auth.php">
                <label for="click" aria-hidden="true">Registrarme</label>
                <input type="text" name="name" placeholder="usuario" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="tel" name="telefono" placeholder="Telefono" required>
                <input type="password" id="contraseña" name="contraseña" placeholder="contraseña" required>
                <input type="password" id="confirm_contraseña" name="confirm_contraseña" placeholder="Reingrese contraseña" required>
                <button type="submit" name="register">Registrarme</button>
            </form>
            
            <form class="ingresar" method="POST" action="../actions/auth.php">
                <label for="click" aria-hidden="true">Ingresar</label>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="contraseña" placeholder="contraseña" required>
                <button type="submit" name="login">Login</button>
            </form>
            
        </div>
        
    </div>

    
    <script src="../assets/js/login.js"></script>
    <script src="../assets/js/msg.js"></script>

</body>
</html>
