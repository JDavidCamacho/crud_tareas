<?php
require_once '../../business/MaterialService.php';

// Instancia de MaterialService
$materialService = new MaterialService();

// Obtener todos los materiales
$materiales = $materialService->GetAllMaterial();

// Manejo de la búsqueda
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
if ($searchTerm) {
    $materiales = array_filter($materiales, function($material) use ($searchTerm) {
        return stripos($material->getNombre(), $searchTerm) !== false || 
               stripos($material->getId(), $searchTerm) !== false;
    });
}

// Crear el mapeo de unidades: [id_unidad => descripcion]
require_once '../../config/Database.php';
$database = new Database();
$pdo = $database->getConnection();

$query = "SELECT id_unidad, descripcion FROM unidades";
$stmt = $pdo->prepare($query);
$stmt->execute();

$unitsMapping = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $unitsMapping[$row['id_unidad']] = $row['descripcion'];
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
                    <h1 class="page-header">ADMINISTRAR MATERIALES</h1>
                    <a href="create.php" title="Agregar nuevo usuario" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUserModal">Registrar</a>
                </div>
            </div>

                    <form method="POST" class="search-bar mb-3" style="padding-top: 10px;">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Buscar por nombre o id" value="<?php echo htmlspecialchars($searchTerm); ?>">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </form>

            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>U_Medida</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($materiales as $material): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($material->getId()); ?></td>
                            <td><?php echo htmlspecialchars($material->getNombre()); ?></td>
                            <td><?php echo htmlspecialchars($material->getDescripcion()); ?></td>
                            
                            <td><?php echo htmlspecialchars($material->getStock()); ?></td>
                            <td><?php echo htmlspecialchars($material->getPrecio()); ?></td>
                            <td><img src="../../<?php echo htmlspecialchars($material->getImagen()); ?>" alt="" width="50" height="50"/></td>
                            <td>
                                <?php 
                                    // Se muestra la descripción de la unidad si existe en el mapeo,
                                    // sino se muestra el valor original
                                    echo htmlspecialchars(
                                        isset($unitsMapping[$material->getUnidad()]) 
                                        ? $unitsMapping[$material->getUnidad()] 
                                        : $material->getUnidad()
                                    );
                                ?>
                            </td>
                          
                            <td>
                                <a href="edit.php?id=<?php echo htmlspecialchars($material->getId()); ?>"  
                                   title="Editar material"  
                                   class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                               
                                <a href="delete.php?id=<?php echo htmlspecialchars($material->getId()); ?>" title="Eliminar material" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este material?');">
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