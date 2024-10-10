<?php
session_start();
$host = 'localhost';
$db = 'inventario';
$user = 'root'; // Cambia esto según tu configuración
$pass = ''; // Cambia esto según tu configuración

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $contraseña = $_POST['contraseña']; // Almacena la contraseña en texto plano

    $sql = "INSERT INTO usuario (usuario, cargo, contraseña) VALUES ('$usuario', '$cargo', '$contraseña')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro creado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

