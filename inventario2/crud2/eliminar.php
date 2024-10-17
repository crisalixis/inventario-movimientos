<?php
$host = 'localhost';
$db = 'inventario';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejo de la eliminación de un usuario
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);  // Asegurarse de que el ID sea un número entero

    // Ejecutar la consulta de eliminación
    $sql = "DELETE FROM usuario WHERE idUser = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado exitosamente.";
    } else {
        echo "Error eliminando usuario: " . $conn->error;
    }
} else {
    echo "ID inválido para eliminar.";
}

$conn->close();

// Redirigir a usuarios.php después de la eliminación
header("Location: usuarios.php");
exit();
?>
