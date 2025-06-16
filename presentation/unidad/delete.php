<?php
require_once '../../business/UnidadService.php';

// Crear una instancia del servicio de unidad
$unidadService = new UnidadService();

// Verifica si se pasó el ID de la unidad en la URL
if (isset($_GET['id'])) {
    $unidadId = intval($_GET['id']);
    
    try {
        if ($unidadService->DeleteUnidad($unidadId)) { // Asegúrate de que el método DeleteUnidad exista
            echo "Unidad eliminada exitosamente.";
            header("Location: index.php"); 
            exit();
        } else {
            echo "Error al eliminar la unidad.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de unidad no proporcionado.";
    exit();
}
?>