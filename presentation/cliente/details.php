<?php
require_once '../../business/ClienteService.php';

// Crear una instancia del servicio de usuario
$customService = new CustomService();

// Verificar si se ha pasado el ID del usuario en la URL
if (isset($_GET['id'])) {
    $customId = intval($_GET['id']);
    
    try {
        // Obtener los detalles del usuario
        $custom = $customService->GetCustomByNombre($customId);
        
        if ($custom) {
            // Mostrar los detalles del usuario
            ?>

<?php include '../Shared/header.php'; ?>

<?php include '../Shared/nav.php'; ?>

<?php include '../Shared/aside.php'; ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <h1 class="page-header">Detalles del Cliente</h1>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td><?php echo htmlspecialchars($custom->getId()); ?></td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td><?php echo htmlspecialchars($custom->getNombre()); ?></td>
                        </tr>
                        <tr>
                            <th>Apellido</th>
                            <td><?php echo htmlspecialchars($custom->getApellido()); ?></td>
                        </tr>

                        <tr>
                            <th>Correo Electronico</th>
                            <td><?php echo htmlspecialchars($custom->getEmail()); ?></td>
                        </tr>

                        <tr>
                            <th>Direccion</th>
                            <td><?php echo htmlspecialchars($custom->getDireccion()); ?></td>
                        </tr>
                        <tr>
                            <th>Telefono</th>
                            <td><?php echo htmlspecialchars($custom->getTelefono()); ?></td>
                        </tr>
                    </table>
                    <a href="index.php" class="btn btn-secondary mt-3">Volver a la lista</a>
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
                    <?php
        } else {
            echo "Usuario no encontrado.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>