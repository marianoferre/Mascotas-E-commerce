<?php
session_start(); 

if (isset($_SESSION['carrito'])) {
    // Vaciar el carrito estableciendo el arreglo en vacío
    $_SESSION['carrito'] = []; 
}

// Mostrar un mensaje de éxito y redirigir a home.php
echo "<script>
        alert('El carrito ha sido vaciado.');
        window.location.href = '../pages/home.php'; // Cambiar a la URL deseada
      </script>";
exit; 
?>
