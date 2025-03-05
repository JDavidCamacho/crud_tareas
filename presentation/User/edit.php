<?php
// edit_user.php
require_once '../../business/UsuarioService.php';

$userService = new UserService();

// Verificar si se recibe un ID de usuario para editar
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user = $userService->getUserById($userId);

    if (!$user) {
        echo "Usuario no encontrado.";
        exit;
    }
} else {
    echo "ID de usuario no proporcionado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($username, $password, $user->getId());

    // Actualizar usuario existente
    $success = $userService->updateUser($user);

    if ($success) {
        header('Location: index.php'); // Redirigir a la lista de usuarios
        exit;
    } else {
        echo "Error al actualizar el usuario.";
    }
}
?>

<?php include '../Shared/header.php'; ?>

<?php include '../Shared/nav.php'; ?>

<?php include '../Shared/aside.php'; ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Editar Usuario</h1>
                    </div>
                </div>

                <form action="edit.php?id=<?php echo $userId; ?>" method="post">
                    <div class="form-group">
                        <label for="username">Nombre</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user->getUsername()); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($user->getPassword()); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
                <a href="index.php" class="btn btn-secondary mt-3">Volver a la lista</a>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../../public/js/jquery.min.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/metisMenu.min.js"></script>
    <script src="../../public/js/startmin.js"></script>
</body>

</html>