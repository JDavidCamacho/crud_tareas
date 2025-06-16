<?php
// Index: Principal
//Llamar a la capa de negocio pero de usuario
require_once '../../business/UsuarioService.php';

// Instancia de UserService
$userService = new UserService();

// Obtener todos los usuarios
$usuarios = $userService->getAllUsers();

//filtrar usuarios
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
if(!empty($searchTerm)) {
    $usuarios = array_filter($usuarios, function($usuario) use ($searchTerm) {
        return stripos($usuario->getNombre(), $searchTerm) !== false || 
               stripos($usuario->getApellido(), $searchTerm) !== false || 
               stripos($usuario->getUsuario(), $searchTerm) !== false;
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
                            <h1 class="page-header">ADMINISTRAR USUARIO</h1>
                            <a href="create.php" title="Agregar nuevo usuario" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUserModal">Registrar</a>
                        </div>
                    </div>


            <form method="POST" class="search-bar mb-3" style="margin-top: 20px;">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar por nombre, apellido o usuario">  
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>


                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Usuario</th>
                                <th>Correo Electronico</th>
                                <th>Contraseña</th>
                                
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($usuario->getId()); ?></td>
                                    <td><?php echo htmlspecialchars($usuario->getNombre()); ?></td>
                                    <td><?php echo htmlspecialchars($usuario->getApellido()); ?></td>
                                    <td><?php echo htmlspecialchars($usuario->getUsuario()); ?></td>
                                    <td><?php echo htmlspecialchars($usuario->getCorreo()); ?></td>
                                    <td><?php echo htmlspecialchars($usuario->getPassword()); ?></td>
                                 
                                    <td>
                                        <a href="edit.php?id=<?php echo htmlspecialchars($usuario->getId()); ?>" 
                                           title="Editar usuario" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                      
                                        <a href="delete.php?id_usuario=<?php echo htmlspecialchars($usuario->getId()); ?>" 
                                        title="Eliminar usuario" 
                                        class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
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