<?php
// Index: Principal
//Llamar a la capa de negocio pero de usuario
require_once '../../business/Rolservice.php';

// Instancia de UserService
$rolService = new RolService();

// Obtener todos los usuarios
$roles = $rolService->ObtenerRoles();

//filtrar unidad de medida
// $searchTerm = isset($_POST['search']) ? $_POST['search'] : '';//el search sirve para mantener el valor de busqueda
// if($searchTerm){
//     $unidades = array_filter($unidades, function($unidad) use ($searchTerm) {//el array filter sirbe para filtrar los clientes
//         // busca la posicion de la primera aparicion de una subcadena dentro de una cadena sin importar si es mayuscula o minuscula
//         return stripos($unidad->getDescripcion(), $searchTerm) !== false || // Filtrar por nombre
//                stripos($unidad->getAbreviatura(), $searchTerm) !== false|| // Filtrar por abreviatura
//                 stripos($unidad->getId(), $searchTerm) !== false; // Filtrar por id
//     });
// }
?>
<?php include '../Shared/header.php'; ?>

        <div id="wrapper">

            <?php include '../Shared/nav.php'; ?>

            <?php include '../Shared/aside.php'; ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">ADMINISTRAR ROL</h1>
                            <a href="crear.php" title="Agregar nuevo rol" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUserModal">Registrar</a>
                        </div>
                    </div>


                    <form method="POST" class="search-bar mb-3" style="padding-top: 10px;">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Buscar por nombre" value="<?php echo htmlspecialchars($searchTerm); ?>">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </form>

                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                              
                                
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roles as $rol): ?>
                                <tr>

                                    <td><?php echo htmlspecialchars($rol->getId()); ?></td>
                                    <td><?php echo htmlspecialchars($rol->getNombre()); ?></td>
                                    <td><?php echo htmlspecialchars($rol->getDescripcion()); ?></td>
                                    
                                  

                                    <td>
                                        <a href="Editar.php?id=<?php echo htmlspecialchars($rol->getId()); ?>" 
                                           title="Editar rol" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                        <a href="delete.php?id=<?php echo htmlspecialchars($rol->getId()); ?>" 
                                        title="Eliminar unidad" 
                                        class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta unidad?');">
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