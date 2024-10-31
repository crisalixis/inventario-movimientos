<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $email = $conn->real_escape_string($_POST['email']);
    $movil = $conn->real_escape_string($_POST['movil']);
    $nombre_completo = $conn->real_escape_string($_POST['nombre_completo']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    // Verificar si el usuario ya existe
    $check_user_sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
    $check_user_result = $conn->query($check_user_sql);

    if ($check_user_result->num_rows > 0) {
        // Si el usuario ya existe, mostrar un mensaje de error
        echo "Error: El usuario '$usuario' ya está registrado.";
    } else {
        // Insertar el nuevo usuario si no existe
        $sql = "INSERT INTO usuario (usuario, cargo, email, movil, contraseña,nombre_completo) VALUES ('$usuario', '$cargo', '$email', '$movil', '$contraseña')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Usuario creado exitosamente.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>
