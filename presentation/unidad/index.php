<?php
// Index: Principal
//Llamar a la capa de negocio pero de usuario
require_once '../../business/UnidadService.php';

// Instancia de UserService
$unidadService = new UnidadService();

// Obtener todos los usuarios
$unidades = $unidadService->GetAllUnidad();

//filtrar unidad de medida
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';//el search sirve para mantener el valor de busqueda
if($searchTerm){
    $unidades = array_filter($unidades, function($unidad) use ($searchTerm) {//el array filter sirbe para filtrar los clientes
        // busca la posicion de la primera aparicion de una subcadena dentro de una cadena sin importar si es mayuscula o minuscula
        return stripos($unidad->getDescripcion(), $searchTerm) !== false || // Filtrar por nombre
               stripos($unidad->getAbreviatura(), $searchTerm) !== false|| // Filtrar por abreviatura
                stripos($unidad->getId(), $searchTerm) !== false; // Filtrar por id
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
                            <h1 class="page-header">ADMINISTRAR UNIDAD DE MEDIDA</h1>
                            <a href="create.php" title="Agregar nueva unidad" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUserModal">Registrar</a>
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
                                <th>Descripcion</th>
                                <th>Abreviatura</th>
                                
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($unidades as $unidad): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($unidad->getId()); ?></td>
                                    <td><?php echo htmlspecialchars($unidad->getDescripcion()); ?></td>
                                    <td><?php echo htmlspecialchars($unidad->getAbreviatura()); ?></td>
                                  

                                    <td>
                                        <a href="edit.php?id=<?php echo htmlspecialchars($unidad->getId()); ?>" 
                                           title="Editar unidad" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                        <a href="delete.php?id=<?php echo htmlspecialchars($unidad->getId()); ?>" 
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