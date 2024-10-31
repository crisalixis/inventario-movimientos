<?php
session_start();

// Destruir todas las sesiones
$_SESSION = array(); // Limpiar las variables de sesión
session_destroy(); // Destruir la sesión actual

// Redirigir al login
header("Location: login.html");
exit();
?>
