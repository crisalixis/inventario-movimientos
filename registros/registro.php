<?php
session_start();
$host = 'localhost';
$db = 'inventario';
$user = 'root'; // Cambia esto según tu configuración
$pass = ''; // Cambia esto según tu configuración

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escapar caracteres especiales y obtener los datos del formulario
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $contraseña = $_POST['contraseña'];

    // Encriptar la contraseña usando password_hash()
    $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

    // Usar prepared statement para evitar inyección SQL
    $stmt = $conn->prepare("INSERT INTO usuario (usuario, cargo, contraseña) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $cargo, $contraseña_hash);

    // Ejecutar y verificar el resultado
    if ($stmt->execute()) {
        echo "Registro creado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar el statement
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>
