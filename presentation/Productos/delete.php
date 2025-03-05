<?php
require_once '../../business/ProductoService.php';

// Crear una instancia del servicio de usuario
$productoService = new ProductoService();

// Verifica si se paso el ID del usuario en la URL
if (isset($_GET['id'])) {
    $productoId = intval($_GET['id']);
    
    try {
        if ($productoService->deleteProducto($productoId)) {
            echo "Producto eliminado exitosamente.";
            header("Location: index.php"); 
            exit();
        } else {
            echo "Error al eliminar el producto.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de producto no proporcionado.";
    exit();
}
?>