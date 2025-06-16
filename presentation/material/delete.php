<?php
require_once '../../business/MaterialService.php';

// Crear una instancia del servicio de usuario
$materialService = new MaterialService();

// Verifica si se paso el ID del usuario en la URL
if (isset($_GET['id'])) {
    $materialId = intval($_GET['id']);
    
    try {
        if ($materialService->deleteMaterial($materialId)) {
            echo "material eliminado exitosamente.";
            header("Location: index.php"); 
            exit();
        } else {
            echo "Error al eliminar el material.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de usuario no proporcionado.";
    exit();
}
?>