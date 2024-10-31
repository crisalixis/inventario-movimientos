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

// Manejo de la creación de un nuevo usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $nombre_completo = $conn->real_escape_string($_POST['nombre_completo']);
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $movil = preg_match('/^[0-9]{10}$/', $_POST['movil']) ? $_POST['movil'] : null;
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    if ($email && $movil) {
        $sql = "INSERT INTO usuario (nombre_completo, usuario, cargo, email, movil, contraseña) VALUES ('$nombre_completo', '$usuario', '$cargo', '$email', '$movil', '$contraseña')";
        if ($conn->query($sql) === TRUE) {
            echo "Usuario creado exitosamente.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: Verifica el formato del correo y el número de móvil.";
    }
}

// Obtener todos los usuarios para mostrar en la tabla
$sql = "SELECT idUser, nombre_completo, usuario, cargo, email, movil FROM usuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="stilo.css">
</head>
<body>
    <div class="container">
        <h1>Usuarios Registrados</h1>

        <h2>Lista de Usuarios</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Usuario</th>
                <th>Cargo</th>
                <th>Email</th>
                <th>Móvil</th>
                <th>Acciones</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['idUser']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre_completo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['usuario']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cargo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['movil']) . "</td>";
                    echo "<td>
                        <a href='editar.php?id=" . htmlspecialchars($row['idUser']) . "'>Editar</a> |
                        <a href='eliminar.php?id=" . htmlspecialchars($row['idUser']) . "' onclick=\"return confirm('¿Estás seguro de que quieres eliminar este usuario?');\">Eliminar</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay usuarios registrados.</td></tr>";
            }
            ?>
        </table>

        <!-- Formulario para registro de usuarios -->
        <form action="usuario.php" method="post">
            <h2>Registrar Usuario</h2>
            <input type="text" name="nombre_completo" placeholder="Nombre Completo" required>
            <input type="text" name="usuario" placeholder="Nombre de Usuario" required>
            <select name="cargo" required>
                <option value="" disabled selected>Seleccione un cargo</option>
                <option value="Administrador">Administrador</option>
                <option value="Invitado">Invitado</option>
                <option value="Encargado">Encargado</option>
                <option value="Pañolero">Pañolero</option>
                <option value="Directivo">Directivo</option>
                <option value="Docente">Docente</option>
                <option value="Estudiante">Estudiante</option>
            </select>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="movil" placeholder="Móvil (10 dígitos)" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <input type="hidden" name="action" value="create">
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
