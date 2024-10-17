<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ingresom";  // Cambiar el nombre de la base de datos según sea necesario

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $fecha_ingreso = $_POST['fecha_ingreso'];

    // Insertar el material en la base de datos
    $sql = "INSERT INTO materiales (nombre, cantidad, fecha_ingreso) 
    VALUES ('$nombre', $cantidad, '$fecha_ingreso')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo material agregado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Material</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        input, textarea {
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
            cursor: pointer;
            padding: 15px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Ingresar Nuevo Material</h1>

<!-- Formulario para ingresar material -->
<form action="" method="POST">
    <label for="nombre">Nombre del Material:</label>
    <input type="text" id="nombre" name="nombre" required>

    

    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" required>

    <label for="fecha_ingreso">Fecha de Ingreso:</label>
    <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>

    <input type="submit" value="Agregar Material">
</form>

</body>
</html>
