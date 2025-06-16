<?php
// edit_user.php
require_once '../../business/RolService.php';

$rolService = new RolService();

// Verificar si se recibe un ID de usuario para editar
if (isset($_GET['id'])) {
    $rolId = $_GET['id'];
    $nombre = $_GET['nombre'];
    $descripcion = $_GET['descripcion'];
    $estado = 1; // Estado activo por defecto
    $rol = $rolService->BuscarRolId($rolId);

    if (!$rol) {
        echo "rol no encontrado.";
        exit;
    }
} else {
    echo "ID de rol no proporcionado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $estado = 1;

    $rol = new Rol($nombre,$descripcion,$estado, $rolId);

    // Actualizar rol existente
    $success = $rolService->EditarRol($rol);

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
                        <h1 class="page-header">EDITAR UNIDAD DE MEDIDA</h1>
                    </div>
                </div>

                <form action="Editar.php?id=<?php echo $rolId; ?>" method="post">
                     <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($rol->getNombre()); ?>" required>
                    </div>
                <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($rol->getDescripcion()); ?>" required>
                    </div>
                   

                   
                    

                    <button type="submit" class="btn btn-primary">Guardar</button>
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