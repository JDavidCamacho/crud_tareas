<?php
// edit_user.php
require_once '../../business/ClienteService.php';

$customService = new CustomService();

// Verificar si se recibe un ID de usuario para editar
if (isset($_GET['id'])) {
    $customId = $_GET['id'];
    $custom = $customService->GetCustomByNombre($customId);

    if (!$custom) {
        echo "Usuario no encontrado.";
        exit;
    }
} else {
    echo "ID de usuario no proporcionado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    $custom = new Custom($nombre, $apellido, $email, $direccion, $telefono, $customId);

    // Actualizar usuario existente
    $success = $customService->UpdateCustom($custom);

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
                        <h1 class="page-header">Editar Cliente</h1>
                    </div>
                </div>

                <form action="edit.php?id=<?php echo $customId; ?>" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($custom->getNombre()); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="apellido" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($custom->getApellido()); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electronico</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($custom->getEmail()); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="direccion" class="form-control" id="direccion" name="direccion" value="<?php echo htmlspecialchars($custom->getDireccion()); ?>" required>
                    </div>


                    <div class="form-group">
                        <label for="telefono">telefono</label>
                        <input type="telefono" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($custom->getTelefono()); ?>" required>
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