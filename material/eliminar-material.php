<?php
include "config/db.php"; // Conexión a la base de datos

// Verificar si se recibe el ID del material en la URL
if (!empty($_GET['id'])) {
    $idmaterial = $_GET['id'];

    // Ejecutar la consulta para cambiar el estado a 0 (marcar como eliminado)
    $query_delete = mysqli_query($conexion, "UPDATE materiales SET estado = 0 WHERE idmaterial = $idmaterial");

    // Redirigir a lista-material.php si la eliminación fue exitosa
    if ($query_delete) {
        header("Location: lista-materiales.php");
        exit();
    } else {
        echo "Error al eliminar el material.";
    }
} else {
    // Redirigir si el ID no está definido
    header("Location: lista-materiales.php");
    exit();
}
?>
