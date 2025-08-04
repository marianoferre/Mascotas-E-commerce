<?php
session_start();
include '../includes/db.php';
$isUpdating = isset($_GET['id']); // Detecta si estamos en modo de actualización
$user = null;

if ($isUpdating) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    $user = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isUpdating ? 'Actualizar Usuario' : 'Agregar Usuario'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/prueba.css">
</head>
<body>
    <?php include('../includes/header.php'); ?>
    <section class="form-section">
        <form class="user-form" action="<?php echo $isUpdating ? '../actions/actualizar_usuario.php' : '../actions/agregar_usuario.php'; ?>" method="POST">
            <h2><?php echo $isUpdating ? 'Actualizar Usuario' : 'Agregar Usuario'; ?></h2>
            
            <!-- ID (solo lectura si estamos actualizando) -->
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?php echo $user['id'] ?? ''; ?>" <?php echo $isUpdating ? 'readonly' : ''; ?> required>

            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username'] ?? ''; ?>" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email'] ?? ''; ?>" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $user['telefono'] ?? ''; ?>" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" <?php echo $isUpdating ? '' : 'required'; ?>>

            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" <?php echo $isUpdating ? '' : 'required'; ?>>

            <label for="role">Rol:</label>
            <select id="role" name="role" required>
                <option value="admin" <?php echo isset($user['role']) && $user['role'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                <option value="subscriber" <?php echo isset($user['role']) && $user['role'] === 'subscriber' ? 'selected' : ''; ?>>Suscriptor</option>
            </select>

            <button type="submit" class="btn-submit"><?php echo $isUpdating ? 'Actualizar Usuario' : 'Agregar Usuario'; ?></button>
        </form>
    </section>
    <?php include('../includes/footer.php'); ?>
</body>
</html>
