<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ingresom";  // Cambiar el nombre de la base de datos si es necesario

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario de movimiento
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tipo_movimiento'])) {
    $id_material = $_POST['id_material'];
    $tipo_movimiento = $_POST['tipo_movimiento'];
    $cantidad = $_POST['cantidad_movimiento'];
    $fecha_movimiento = $_POST['fecha_movimiento'];
    $usuario = $_POST['usuario'];

    // Insertar el movimiento en la tabla
    $sql_mov = "INSERT INTO movimientos (id_material, tipo_movimiento, cantidad, fecha_movimiento, usuario)
                VALUES ($id_material, '$tipo_movimiento', $cantidad, '$fecha_movimiento', '$usuario')";

    if ($conn->query($sql_mov) === TRUE) {
        echo "Movimiento registrado exitosamente.";
    } else {
        echo "Error: " . $sql_mov . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Movimiento de Material</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Registrar Movimiento de Material</h1>

<!-- Formulario para registrar un movimiento -->
<form action="registrar_movimiento.php" method="POST">
    <label for="id_material">Selecciona el Material:</label>
    <select id="id_material" name="id_material" required>
        <option value="">--Selecciona un Material--</option>
        <?php
        // Obtener la lista de materiales para el select
        $sql_materiales = "SELECT id_material, nombre FROM materiales";
        $result_materiales = $conn->query($sql_materiales);

        if ($result_materiales->num_rows > 0) {
            while ($row_material = $result_materiales->fetch_assoc()) {
                echo "<option value='" . $row_material['id_material'] . "'>" . $row_material['nombre'] . "</option>";
            }
        } else {
            echo "<option value=''>No hay materiales</option>";
        }
        ?>
    </select>

    <label for="tipo_movimiento">Tipo de Movimiento:</label>
    <select id="tipo_movimiento" name="tipo_movimiento" required>
        <option value="entrada">Entrada</option>
        <option value="salida">Salida</option>
        <option value="ajuste">Ajuste</option>
    </select>

    <label for="cantidad_movimiento">Cantidad:</label>
    <input type="number" id="cantidad_movimiento" name="cantidad_movimiento" required>

    <label for="fecha_movimiento">Fecha del Movimiento:</label>
    <input type="date" id="fecha_movimiento" name="fecha_movimiento" required>

    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" required>

    <input type="submit" value="Registrar Movimiento">
</form>

</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
