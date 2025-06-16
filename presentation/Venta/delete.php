<?php
require_once '../../business/VentaService.php';

// Crear una instancia del servicio de usuario
$ventaService = new VentaService();

// Verifica si se paso el ID del usuario en la URL
if (isset($_GET['id'])) {
    $ventaId = intval($_GET['id']);
    
    try {
        if ($ventaService->DeleteVenta($ventaId)) {
            
            header("Location: index.php?message=Venta eliminada exitosamente."); 
            exit();
        } else {
            echo "Error al eliminar la venta.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de venta no proporcionado.";
    exit();
}
?>