<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombreHerramienta = $_POST['nombreHerramienta'];
    $tipoAccion = $_POST['tipoAccion'];
    $cantidad = $_POST['cantidad'];
    $responsable = $_POST['responsable'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO inventario (nombre_herramienta, tipo_accion, cantidad, responsable) VALUES (:nombre_herramienta, :tipo_accion, :cantidad, :responsable)";
    
    try {
        // Preparar la declaración
        $stmt = $conn->prepare($sql);
        
        // Vincular los parámetros
        $stmt->bindParam(':nombre_herramienta', $nombreHerramienta);
        $stmt->bindParam(':tipo_accion', $tipoAccion);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':responsable', $responsable);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        echo "Registro guardado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al guardar el registro: " . $e->getMessage();
    }
} else {
    echo "No se recibieron datos.";
}

// Cerrar la conexión
$conn = null; // Esto cierra la conexión en PDO
?>
