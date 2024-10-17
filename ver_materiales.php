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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiales y Movimientos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Materiales Registrados</h1>
<?php
// Consulta para mostrar los materiales
$sql_materiales = "SELECT * FROM materiales";
$result_materiales = $conn->query($sql_materiales);

if ($result_materiales->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID Material</th><th>Nombre</th><th>Cantidad</th><th>Fecha Ingreso</th></tr>";

    while ($row_material = $result_materiales->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_material['id_material'] . "</td>";
        echo "<td>" . $row_material['nombre'] . "</td>";
        echo "<td>" . $row_material['cantidad'] . "</td>";
        echo "<td>" . $row_material['fecha_ingreso'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay materiales registrados.</p>";
}
?>

<h2>Movimientos Registrados</h2>
<?php
// Consulta para mostrar los movimientos
$sql_movimientos = "SELECT m.id_material, m.tipo_movimiento, m.cantidad, m.fecha_movimiento, m.usuario
                    FROM movimientos m JOIN materiales ma ON m.id_material = ma.id_material";
$result_movimientos = $conn->query($sql_movimientos);

if ($result_movimientos->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Tipo de Movimiento</th><th>Cantidad de Movimiento</th><th>Fecha del Movimiento</th><th>Usuario</th></tr>";

    while ($row_mov = $result_movimientos->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_mov['tipo_movimiento'] . "</td>";
        echo "<td>" . $row_mov['cantidad'] . "</td>";
        echo "<td>" . $row_mov['fecha_movimiento'] . "</td>";
        echo "<td>" . $row_mov['usuario'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay movimientos registrados.</p>";
}

// Cerrar la conexión
$conn->close();
?>

</body>
</html>
