<?php
// create_user.php
require_once '../../business/ProveedorService.php';

$proveedorService = new ProveedorService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $razon_social = $_POST['razon_social'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $nit = $_POST['nit_ci'];
    $correo = $_POST['correo'];
    $estado = 1; // Estado activo por defecto
    

    $proveedor = new Proveedor($razon_social, $telefono, $direccion, $nit, $correo, $estado);
    // Crear nuevo usuario
    $success = $proveedorService->CrearProveedor($proveedor);

    if ($success) {
        header('Location: index.php'); // Redirigir a la lista de usuarios
        exit;
    } else {
        echo "Error al crear el usuario.";
    }
}
?>
<?php include '../Shared/header.php'; ?>

<?php include '../Shared/nav.php'; ?>

<?php include '../Shared/aside.php'; ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Registrar Proveedor</h1>
                            </div>
                        </div>
                        <form action="crear.php" method="post">
                            <div class="form-group">
                                <label for="razon_social">Razon Social</label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="direccion" class="form-control" id="direccion" name="direccion" required>
                            </div>
                            <div class="form-group">
                                <label for="nit_ci">Nit/ci</label>
                                <input type="number" class="form-control" id="nit_ci" name="nit_ci" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo Electronico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Registrar  Proveedor</button>
                        </form>
                        <a href="index.php" class="btn btn-secondary mt-3">Volver a la lista</a>
                    </div>
                </div>    
            </div>
            <!-- /#wrapper -->

            <!-- jQuery -->
            <script src="../public/js/jquery.min.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="../public/js/bootstrap.min.js"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="../public/js/metisMenu.min.js"></script>

            <!-- Morris Charts JavaScript -->
            <script src="../public/js/raphael.min.js"></script>
            <script src="../public/js/morris.min.js"></script>
            <script src="../public/js/morris-data.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="../public/js/startmin.js"></script>

        </body>

        </html>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>