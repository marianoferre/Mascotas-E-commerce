<?php
session_start();

// Eliminar todas las variables de sesión individualmente
$_SESSION = array();

// Si se desea destruir la cookie de sesión, también se puede hacer
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente destruir la sesión
session_destroy();

// Redirigir al usuario y mostrar mensaje de éxito
echo "<script>
    alert('Se ha deslogueado correctamente.');
    window.location.href = '../pages/login.php';
</script>";
exit;
?>