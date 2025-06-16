<?php
// edit_user.php
require_once '../../business/ProveedorService.php';

$proveedorService = new ProveedorService();

// Verificar si se recibe un ID de usuario para editar
if (isset($_GET['id'])) {
    $proveedorId = $_GET['id']; // Asegúrate de validar y sanitizar el ID
    $proveedor = $proveedorService->ObtenerProveedorId($proveedorId);

    if (!$proveedor) {
        echo "Proveedor no encontrado.";
        exit;
    }
} else {
    echo "ID de proveedor no proporcionado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    // Obtener datos del formulario
    $razon_social = $_POST['razon_social'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $nit = $_POST['nit_ci'];
    $correo = $_POST['correo'];
    $estado = 1; // Asignar estado activo por defecto
    

    $proveedor = new Proveedor($razon_social, $telefono, $direccion, $nit, $correo, $estado, $proveedorId);

    // Actualizar usuario existente
    $success = $proveedorService->EditarProveedor($proveedor);

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

                <form action="Editar.php?id=<?php echo $proveedorId; ?>" method="post">
                    <div class="form-group">
                        <label for="razon_social">Razon Social</label>
                        <input type="text" class="form-control" id="razon_social" name="razon_social" value="<?php echo htmlspecialchars($proveedor->getRazonSocial()); ?>" required>       
                    </div>

                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($proveedor->getTelefono()); ?>" required>   
                    </div>
                    <div class="form-group
">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo htmlspecialchars($proveedor->getDireccion()); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nit_ci">Nit/ci</label>
                        <input type="number" class="form-control" id="nit_ci" name="nit_ci" value="<?php echo htmlspecialchars($proveedor->getNit()); ?>" required>
                    </div>
                    <div class="form-group  
">
                        <label for="correo">Correo Electronico</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($proveedor->getCorreo()); ?>" required>
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