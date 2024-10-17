<?php
$servername = "localhost"; // Cambia según sea necesario
$username = "root"; // Cambia según sea necesario
$password = ""; // Cambia según sea necesario
$dbname = "control_inventario"; // Cambia según sea necesario

try {
    // Crear conexión
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurar el modo de error de PDO para que lance excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
?>
