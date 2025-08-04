<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['carrito'])) {
    $id = $_GET['id'];
    $arreglo = $_SESSION['carrito'];

    // Buscar y eliminar el producto en el carrito
    foreach ($arreglo as $index => $producto) {
        if ($producto['Id'] == $id) {
            unset($arreglo[$index]);
            $_SESSION['carrito'] = array_values($arreglo); // Reindexar el arreglo
            break;
        }
    }
}
header("Location: ../pages/carrito.php"); // Redirigir de vuelta al carrito
exit();