<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="style.css"> <!-- Si tienes un archivo de estilos -->
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h1>
        <p>Has iniciado sesión correctamente.</p>
        <p>Tu cargo es: <?php echo htmlspecialchars($_SESSION['cargo']); ?></p>
        <p><a href="logout.php">Cerrar sesión</a></p>
    </div>
</body>
</html>
