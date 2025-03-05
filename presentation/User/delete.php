<?php
require_once '../../business/UsuarioService.php';

// Crear una instancia del servicio de usuario
$userService = new UserService();

// Verifica si se paso el ID del usuario en la URL
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    
    try {
        if ($userService->deleteUser($userId)) {
            echo "Usuario eliminado exitosamente.";
            header("Location: index.php"); 
            exit();
        } else {
            echo "Error al eliminar el usuario.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de usuario no proporcionado.";
    exit();
}
?>