<?php
// includes/install.php
include '../includes/db.php';

// Crear base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS `ecommerce-mascotas`";
$conn->query($sql);

// Seleccionar la base de datos
$conn->select_db("ecommerce-mascotas");

// Crear tabla 'users' si no existe
$sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(50) NOT NULL,
            `email` VARCHAR(100) NOT NULL,
            `telefono` VARCHAR(15),
            `password` VARCHAR(255) NOT NULL,
            `role` ENUM('admin', 'subscriber') NOT NULL DEFAULT 'subscriber'
        )";

$conn->query($sql);



// Crear tabla 'products' si no existe
$sql = "CREATE TABLE IF NOT EXISTS `products` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(255) NOT NULL,
    `categoria` VARCHAR(255) NOT NULL,
    `descripcion` TEXT,
    `precio` DECIMAL(10, 2) NOT NULL,
    `stock` INT NOT NULL,
    `image_url` VARCHAR(255) NOT NULL,
    `user_id` INT(11),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
)";

$conn->query($sql);

// Tabla carrito

$sql= "CREATE TABLE IF NOT EXISTS carrito (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    producto_id INT(11),
    cantidad INT(11) NOT NULL,
    `user_id` INT(11),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (producto_id) REFERENCES products(id) ON DELETE CASCADE
    
)" ;


$conn->query($sql);

// Verificar e insertar usuarios si no existen
$checkAdmin = "SELECT * FROM `users` WHERE `email` = 'admin@admin.com'";
$resultAdmin = $conn->query($checkAdmin);

if ($resultAdmin->num_rows == 0) {
    $username = 'Admin';
    $email = 'admin@admin.com';
    $telefono = '123456789';
    $password = 'admin';
    $contraseña_hash = password_hash($password, PASSWORD_DEFAULT);
    $role = 'admin';

    $insertAdmin = "INSERT INTO `users` (`username`, `email`, `telefono`, `password`, `role`) 
                    VALUES ('$username', '$email', '$telefono', '$contraseña_hash', '$role')";
    $conn->query($insertAdmin);
}

$checkSubscriber = "SELECT * FROM `users` WHERE `email` = 'subs@subs.com'";
$resultSubscriber = $conn->query($checkSubscriber);

if ($resultSubscriber->num_rows == 0) {
    $username = 'Subscriber';
    $email = 'subs@subs.com';
    $telefono = '987654321';
    $password = 'subs';
    $contraseña_hash = password_hash($password, PASSWORD_DEFAULT);
    $role = 'subscriber';

    $insertSubscriber = "INSERT INTO `users` (`username`, `email`, `telefono`, `password`, `role`) 
                         VALUES ('$username', '$email', '$telefono', '$contraseña_hash', '$role')";
    $conn->query($insertSubscriber);
}

$sql= "CREATE TABLE IF NOT EXISTS ventas (

    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT(11),
    precio DECIMAL (10, 2) NOT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES `users`(`id`) ON DELETE SET NULL  

)";

$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `productos_venta` (
   id INT(11) AUTO_INCREMENT PRIMARY KEY,
   id_venta INT(11) NOT NULL,
   id_producto INT(11) NOT NULL,
   cantidad INT(11) NOT NULL,
   precio DECIMAL(10, 2) NOT NULL,
   total DECIMAL(10, 2) NOT NULL,
   FOREIGN KEY (id_venta) REFERENCES ventas(id) ON DELETE CASCADE, 
   FOREIGN KEY (id_producto) REFERENCES products(id) 
)";

$conn->query($sql);


/*
    // CREAR UN ADMINISTRADOR

    $username= 'Mariano';
    $email= 'mariano@ejemplo.com';
    $telefono= '616546168';
    $password='123';
    $contraseña_hash = password_hash($password, PASSWORD_DEFAULT);
    $role = 'admin';

    $result = $conn->query( "SELECT * FROM users Where email = '$email'");

    if ( mysqli_num_rows($result)===0){
        // Preparar la consulta para insertar el usuario
    $sql = "INSERT INTO users (username, email, telefono, password, role) VALUES ('$username','$email', '$telefono','$contraseña_hash' ,'$role' )";

    if ( mysqli_query( $conn , $sql ) === true )
        {
            echo "Usuario administrador creado exitosamente";

        }   else {
            echo "Error : " . $conn->error;
        }
    }else {
        echo " El usuario ya existe " ; 
    }

*/
       
    $conn->close();

    ?>