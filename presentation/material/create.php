<?php
// create_user.php
require_once '../../business/MaterialService.php';

$materialService = new MaterialService();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Paso 1: Datos del formulario recibidos.<br>";

    // Obtener datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
  
     $stock = $_POST['stock'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $unidad = $_POST['unidad'] ?? '';
    $estado = $_POST['estado'] ?? '';

    // MANEJAR LA IMAGEN
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        echo "Paso 2: Imagen recibida.<br>";

        // DATOS DEL ARCHIVO A SUBIR
        $file = $_FILES['imagen'];
        $nombreImagen = basename($file['name']);
        $uploadDir = 'C:/xampp/htdocs/sistemadeventas/public/img/papeleria/';

        // Validar directorio
        if (!is_dir($uploadDir)) {
            echo "Error: El directorio de destino no existe.<br>";
            exit;
        }
        if (!is_writable($uploadDir)) {
            echo "Error: El directorio no tiene permisos de escritura.<br>";
            exit;
        }

        // Ruta completa del archivo a subir
        $uploadFile = $uploadDir . $nombreImagen;

        // Mover el archivo
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            echo "Paso 3: La imagen se movió correctamente.<br>";
            $imagenPath = 'public/img/papeleria/' . $nombreImagen;

            // Crear producto
            echo "Paso 4: Intentando crear el producto.<br>";
            $material = new Material($nombre, $descripcion, $stock,$precio, $imagenPath, $unidad, $estado);
            $success = $materialService->createMaterial($material);

            if ($success) {
                echo "Paso 5: Producto creado correctamente.<br>";
                header('Location: index.php');
                exit;
            } else {
                echo "Error al crear el producto.<br>";
            }
        } else {
            echo "Error al mover la imagen.<br>";
        }
    } else {
        echo "No se recibió una imagen válida.<br>";
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
                                <h1 class="page-header">Registrar Material</h1>
                            </div>
                        </div>
                        <form action="create.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                            </div>
                          

                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="text" class="form-control" id="stock" name="stock" required>
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" id="precio" name="precio" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" required>
                            </div>
                            <div class="form-group">
                                <label for="unidad">Unidad</label>
                                <?php
                                // Incluye la conexión a la base de datos
                                require_once '../../config/Database.php';
                                $database = new Database();
                                $pdo = $database->getConnection();

                                // Consulta para extraer las unidades disponibles
                                $query = "SELECT id_unidad, descripcion FROM unidades where estado=1";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                ?>
                                <select class="form-control" id="unidad" name="unidad" required>
                                    <option value="" disabled selected>-- Selecciona una unidad --</option>
                                    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                        <option value="<?php echo htmlspecialchars($row['id_unidad']); ?>">
                                            <?php echo htmlspecialchars($row['descripcion']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                           
                            
                            <button type="submit" class="btn btn-primary">Registrar Material</button>
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


