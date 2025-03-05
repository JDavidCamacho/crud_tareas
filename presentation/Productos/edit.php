<?php
// edit_user.php
require_once '../../business/ProductoService.php';

$productoService = new ProductoService();

// Verificar si se recibe un ID de usuario para editar
if (isset($_GET['id'])) {
    $productoId = $_GET['id'];
    $producto = $productoService->getProductoById($productoId);

    if (!$producto) {
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
    $precio = $_POST['precio'];

    $imagenPath = $producto->getImagen();
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        echo "Paso 2: Imagen recibida.<br>";

        $file = $_FILES['imagen'];
        $nombreImagen = basename($file['name']);
        $uploadDir = 'C:/xampp/htdocs/sistemaweb/public/img/papeleria/';
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

    $producto->setId($productoId);
    $producto->setNombre($nombre);
    $producto->setDescripcion($descripcion);
    $producto->setPrecio($precio);
    $producto->setImagen($imagenPath);

    // Actualizar usuario existente
    $success = $productoService->updateProducto($producto);

    if ($success) {
        header('Location: index.php'); // Redirigir a la lista de usuarios
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
                        <h1 class="page-header">Editar Producto</h1>
                    </div>
                </div>

                <form action="edit.php?id=<?php echo $productoId; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto->getNombre()); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($producto->getDescripcion()); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($producto->getPrecio()); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" required>
                        <img src="../../<?php echo htmlspecialchars($producto->getImagen()); ?>" alt="" width="50" height="50">
                        <p>Imagen cargada </p>
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