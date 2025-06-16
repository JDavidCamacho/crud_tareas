<?php
// Index: Principal
//Llamar a la capa de negocio pero de usuario
require_once '../../business/ProveedorService.php';

// Instancia de UserService
$proveedorService = new ProveedorService();

// Obtener todos los usuarios
$proveedores = $proveedorService->ObtenerProveedores();
// filtrar proveedores
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';//el search sirve para mantener el valor de busqueda
if ($searchTerm) {
    $proveedores = array_filter($proveedores, function($proveedor) use ($searchTerm) {//el array filter sirbe para filtrar los proveedores
        // busca la posicion de la primera aparicion de una subcadena dentro de una cadena sin importar si es mayuscula o minuscula
        return stripos($proveedor->getRazonSocial(), $searchTerm) !== false || 
               stripos($proveedor->getTelefono(), $searchTerm) !== false || 
               stripos($proveedor->getCorreo(), $searchTerm) !== false; // Filtrar por razon social, telefono o correo
    });
}



?>
<?php include '../Shared/header.php'; ?>

        <div id="wrapper">

            <?php include '../Shared/nav.php'; ?>

            <?php include '../Shared/aside.php'; ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">ADMINISTRAR PROVEEDOR</h1>
                            <a href="crear.php" title="Agregar nuevo proveedor" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUserModal">Registrar</a>
                        </div>
                    </div>

                      <form method="POST" class="search-bar mb-3" style="padding-top: 10px;">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Buscar por nombre, apellido o correo" value="<?php echo htmlspecialchars($searchTerm); ?>">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </form>


                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Razon Social</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>Nit/ci</th>
                                <th>Correo Electronico</th>

                                
                                
                                
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proveedores as $proveedor): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($proveedor->getId()); ?></td>
                                    <td><?php echo htmlspecialchars($proveedor->getRazonSocial()); ?></td>
                                    <td><?php echo htmlspecialchars($proveedor->getTelefono()); ?></td>
                                    <td><?php echo htmlspecialchars($proveedor->getDireccion()); ?></td>
                                    <td><?php echo htmlspecialchars($proveedor->getNit()); ?></td>
                                    <td><?php echo htmlspecialchars($proveedor->getCorreo()); ?></td>
                                   

                                    <td>
                                        <a href="Editar.php?id=<?php echo htmlspecialchars($proveedor->getId()); ?>" 
                                           title="Editar proveedor" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                     
                                        <a href="Eliminar.php?id=<?php echo htmlspecialchars($proveedor->getId()); ?>" title="Eliminar proveedor" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este proveedor?');">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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