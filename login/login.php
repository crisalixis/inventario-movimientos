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
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT * FROM usuario WHERE usuario='$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row['contraseña'])) {
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['cargo'] = $row['cargo'];
            $_SESSION['idUser'] = $row['idUser'];
            header("Location: welcome.php");
            exit();
        } else {
            echo "Contraseña correcta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}

$conn->close();
?>

