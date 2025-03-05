<?php

require_once '../../business/ProductoService.php';

// Instancia de UserService
$productoService = new ProductoService();

// Obtener todos los usuarios
$productos = $productoService->getAllProductos();

?>
<?php include '../Shared/header.php'; ?>

        <div id="wrapper">

            <?php include '../Shared/nav.php'; ?>

            <?php include '../Shared/aside.php'; ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Lista de Productos</h1>
                            <a href="create.php" title="Agregar nuevo usuario" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUserModal">Nuevo</a>
                        </div>
                    </div>
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($producto->getId()); ?></td>
                                    <td><?php echo htmlspecialchars($producto->getNombre()); ?></td>
                                    <td><?php echo htmlspecialchars($producto->getDescripcion()); ?></td>
                                    <td><?php echo htmlspecialchars($producto->getPrecio()); ?></td>
                                    <td>
                                        <img src="../../<?php echo htmlspecialchars($producto->getImagen()); ?>" alt="" width="50" height="50"/></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo htmlspecialchars($producto->getId()); ?>" 
                                           title="Editar producto" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                        <a href="details.php?id=<?php echo htmlspecialchars($producto->getId()); ?>" 
                                           title="Editar producto" 
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i> Ver
                                        </a>
                                        <a href="delete.php?id=<?php echo htmlspecialchars($producto->getId()); ?>" title="Eliminar usuario" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
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