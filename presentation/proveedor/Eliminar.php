<?php
require_once '../../business/ProveedorService.php';

// Crear una instancia del servicio de unidad
$proveedorService = new ProveedorService();

// Verifica si se pasó el ID de la unidad en la URL
if (isset($_GET['id'])) {
    $proveedorId = intval($_GET['id']);
    
    try {
        if ($proveedorService->EliminarProveedor($proveedorId)) { // Asegúrate de que el método DeleteUnidad exista
            echo "proveedor eliminada exitosamente.";
            header("Location: index.php"); 
            exit();
        } else {
            echo "Error al eliminar al proveedor.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de proveedor no proporcionado.";
    exit();
}
?>