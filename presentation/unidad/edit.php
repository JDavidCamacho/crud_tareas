<?php
// edit_user.php
require_once '../../business/UnidadService.php';

$unidadService = new UnidadService();

// Verificar si se recibe un ID de usuario para editar
if (isset($_GET['id'])) {
    $unidadId = $_GET['id'];
    $unidad = $unidadService->FindUnidadById($unidadId);

    if (!$unidad) {
        echo "Unidad no encontrado.";
        exit;
    }
} else {
    echo "ID de unidad no proporcionado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $descripcion = $_POST['descripcion'];
    $abreviatura = $_POST['abreviatura'];
    $estado = 1;

    $unidad = new Unidad($descripcion, $abreviatura,$estado, $unidadId);

    // Actualizar usuario existente
    $success = $unidadService->	UpdateUnidad($unidad);

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

                <form action="edit.php?id=<?php echo $unidadId; ?>" method="post">
                <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($unidad->getDescripcion()); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="abreviatura">Abreviatura</label>
                        <input type="text" class="form-control" id="abreviatura" name="abreviatura" value="<?php echo htmlspecialchars($unidad->getAbreviatura()); ?>" required>
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