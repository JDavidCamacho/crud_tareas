<?php
require_once '../../business/ClienteService.php';

// Crear una instancia del servicio de usuario
$customService = new CustomService();

// Verifica si se paso el ID del usuario en la URL
if (isset($_GET['id'])) {
    $customId = intval($_GET['id']);
    
    try {
        if ($customService->DeleteCliente($customId)) {
            echo "cliente eliminado exitosamente.";
            header("Location: index.php"); 
            exit();
        } else {
            echo "Error al eliminar el cliente.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de cliente no proporcionado.";
    exit();
}
?>