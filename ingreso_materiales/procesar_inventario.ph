<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreHerramienta = $_POST['nombreHerramienta'];
    $tipoAccion = $_POST['tipoAccion'];
    $cantidad = $_POST['cantidad'];
    $responsable = $_POST['responsable'];

    $sql = "INSERT INTO inventario (nombre_herramienta, tipo_accion, cantidad, responsable) VALUES (:nombre_herramienta, :tipo_accion, :cantidad, :responsable)";
    
    try {
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':nombre_herramienta', $nombreHerramienta);
        $stmt->bindParam(':tipo_accion', $tipoAccion);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':responsable', $responsable);
        
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
