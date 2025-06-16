<?php
// edit_user.php
require_once '../../business/MaterialService.php';

// Inicializa correctamente MaterialService
$materialService = new MaterialService();

// Verificar si se recibe un ID de producto para editar
if (isset($_GET['id'])) {
    $materialId = $_GET['id'];
    $material = $materialService->FindMaterialById($materialId);

    if (!$material) {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "ID de producto no proporcionado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];
    $unidad = $_POST['unidad'];
    $estado = $_POST['estado'];

    // Manejo de imagen
    $imagenPath = $material->getImagen();
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        echo "Paso 2: Imagen recibida.<br>";

        $file = $_FILES['imagen'];
        $nombreImagen = basename($file['name']);
        $uploadDir = 'C:/xampp/htdocs/sistemadeventas/public/img/papeleria/';
        $uploadFile = $uploadDir . $nombreImagen;

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            echo "Paso 3: Se movió la imagen.<br>";
            $imagenPath = 'public/img/papeleria/' . $nombreImagen;
        } else {
            echo "No se pudo mover la imagen.<br>";
            exit;
        }
    } else {
        echo "Paso 2: No se cambió la imagen.<br>";
    }

    // Actualización del material
    $material->setId($materialId);
    $material->setNombre($nombre);
    $material->setDescripcion($descripcion);
     $material->setStock($stock);
    $material->setPrecio($precio);
    $material->setImagen($imagenPath);
    $material->setUnidad($unidad);
    $material->setEstado(1);

    // Corregir llamada al método UpdateMaterial
    $success = $materialService->UpdateMaterial($material);

    if ($success) {
        header('Location: index.php'); // Redirigir a la lista de productos
        exit;
    } else {
        echo "Error al actualizar el producto.";
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
                        <h1 class="page-header">Editar Material</h1>
                    </div>
                </div>
                <form action="edit.php?id=<?php echo $materialId; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($material->getNombre()); ?>" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($material->getDescripcion()); ?>" required>
    </div>
    
   
     <div class="form-group">
        <label for="stock">Stock</label>
        <input type="text" class="form-control" id="stock" name="stock" value="<?php echo htmlspecialchars($material->getStock()); ?>" required>
    </div>

    <div class="form-group">
        <label for="precio">Precio</label>
        <input type="text" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($material->getPrecio()); ?>" required>
    </div>

   

    <div class="form-group">
        <label for="imagen">Imagen</label>
        <input type="file" class="form-control" id="imagen" name="imagen">
        <img src="../../<?php echo htmlspecialchars($material->getImagen()); ?>" alt="" width="50" height="50">
        <p>Imagen cargada</p>
    </div>

    <div class="form-group">
        <label for="unidad">Unidad de Medida</label>
        <?php
            // Se incluye la configuración de la base de datos para obtener la conexión
            require_once '../../config/Database.php';
            $database = new Database();
            $pdo = $database->getConnection();
            
            // Consulta para obtener todas las unidades disponibles
            $query = "SELECT id_unidad, descripcion FROM unidades";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $currentUnidad = $material->getUnidad();
        ?>
        <select class="form-control" id="unidad" name="unidad" required>
            <option value="" disabled>-- Selecciona una unidad --</option>
            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo htmlspecialchars($row['id_unidad']); ?>" <?php echo ($row['id_unidad'] == $currentUnidad) ? 'selected' : '';  ?>>
                    <?php echo htmlspecialchars($row['descripcion']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>



    <button type="submit" class="btn btn-primary">Guardar Material</button>
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