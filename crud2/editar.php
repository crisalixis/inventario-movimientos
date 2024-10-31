<?php
// Configuración de conexión
$host = 'localhost';
$db = 'inventario';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejo de la edición de un usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = intval($_POST['id']); // Asegurarse de que el ID sea un número entero
    $nombre_completo = $conn->real_escape_string($_POST['nombre_completo']);
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $email = $conn->real_escape_string($_POST['email']);
    $movil = $conn->real_escape_string($_POST['movil']);
    $contraseña = $_POST['contraseña'];

    // Actualizar los datos
    if (!empty($contraseña)) {
        $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);
        $sql = "UPDATE usuario SET nombre_completo='$nombre_completo', usuario='$usuario', cargo='$cargo', contraseña='$contraseña_hash', email='$email', movil='$movil' WHERE idUser=$id";
    } else {
        $sql = "UPDATE usuario SET nombre_completo='$nombre_completo', usuario='$usuario', cargo='$cargo', email='$email', movil='$movil' WHERE idUser=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado exitosamente.";
    } else {
        echo "Error actualizando usuario: " . $conn->error;
    }
}

// Obtener el usuario para mostrar en el formulario
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM usuario WHERE idUser = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    echo "ID inválido para editar.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="stilo.css">
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="editar.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['idUser']); ?>">
        <label>Nombre Completo:</label>
        <input type="text" name="nombre_completo" value="<?php echo htmlspecialchars($row['nombre_completo']); ?>" required><br>
        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?php echo htmlspecialchars($row['usuario']); ?>" required><br>
        <label>Cargo:</label>
        <select name="cargo" required>
            <option value="Administrador" <?php echo $row['cargo'] == 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
            <option value="Invitado" <?php echo $row['cargo'] == 'Invitado' ? 'selected' : ''; ?>>Invitado</option>
            <option value="Encargado" <?php echo $row['cargo'] == 'Encargado' ? 'selected' : ''; ?>>Encargado</option>
            <option value="Pañolero" <?php echo $row['cargo'] == 'Pañolero' ? 'selected' : ''; ?>>Pañolero</option>
            <option value="Directivo" <?php echo $row['cargo'] == 'Directivo' ? 'selected' : ''; ?>>Directivo</option>
            <option value="Docente" <?php echo $row['cargo'] == 'Docente' ? 'selected' : ''; ?>>Docente</option>
            <option value="Estudiante" <?php echo $row['cargo'] == 'Estudiante' ? 'selected' : ''; ?>>Estudiante</option>
        </select><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br>
        <label>Móvil:</label>
        <input type="text" name="movil" value="<?php echo htmlspecialchars($row['movil']); ?>" required><br>
        <label>Nueva Contraseña (opcional):</label>
        <input type="password" name="contraseña"><br>
        <input type="hidden" name="action" value="update">
        <button type="submit">Guardar cambios</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
