<?php
require_once '../../business/ClienteService.php';
require_once '../../business/MaterialService.php';
require_once '../../business/VentaService.php';
require_once '../../domain/Venta.php';

$ClienteService = new CustomService();
$clientes = $ClienteService->GetAllClientes();

$materialService = new MaterialService();
$materiales = $materialService->GetAllMateriales();


$VentaService = new VentaService();
$ventas = $VentaService->GetAllVenta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  

    $detalles = json_decode($_POST['detalles'], true); // Convierte el JSON a array

    // Validación de los detalles
    if (!is_array($detalles)) {
        echo "Error: formato de detalles inválidos";
        exit;
    }



 // Crear el objeto Venta
    $venta = new Venta(
        $_POST['id_cliente'], // ID del cliente
        $_POST['fecha'],      // Fecha de la venta
        $_POST['total_venta'], // Total de la venta
        $_POST['estado'],
        "Venta realisada"      // Estado de la venta
    );

    try{
            $resultado = $VentaService->RegistrarVentaCompleta($venta, $detalles); // Asegúrate de que la función se llame correctamente

            if(!$resultado['success']){
                echo "error al registrar la venta:" . $resultado['error'];
                exit;

            }
            
            //redirigir a la página de comprobante hacer un metodo que devuelva el ultimo id de venta select max(id_venta) from venta
            header('Location: comprobante.php?id_venta=' . $resultado['id_venta']);
            exit;

    }catch (Exception $e) {
        // Manejo de errores
        echo "Error al registrar la venta: " . $e->getMessage();
    }

    // Llamada al método de negocio para registrar la venta

    // Manejo del resultado de la operación
    if ($resultado['success']) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $resultado['error'];
    }
}
?>

<?php include '../Shared/header.php'; ?>
<?php include '../Shared/nav.php'; ?>
<?php include '../Shared/aside.php'; ?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="container mt-5">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body" style="height: 400px;" id="formularioregistros">
                            <form action="" name="formulario" id="formulario" method="POST">
                                <div class="row">
                                    <div class="form-group col-lg-2">
                                        <label for="cliente_id">Codigo:</label>
                                        <input class="form-control" type="text" id="cliente_id" name="cliente_id" placeholder="ID del Cliente" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="id_cliente">Cliente</label>
                          
                                        <select class="form-control" id="id_cliente" name="id_cliente" required>
                                            <option value="" disabled selected>-- Selecciona un cliente --</option>
                                            <?php foreach ($clientes as $cliente): ?>
                                                <option value="<?php echo htmlspecialchars($cliente['id_cliente']); ?>">
                                                    <?php echo htmlspecialchars($cliente['nombre']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="fecha">Fecha:</label>
                                        <input class="form-control" type="date" name="fecha" id="fecha" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="text-center">MATERIAL</h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-2">
                                        <label for="codigo">Código:</label>
                                        <input class="form-control" type="text" name="codigo" id="codigo" readonly>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label for="precio">Precio:</label>
                                        <input class="form-control" type="text" name="precio" id="precio" readonly>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label for="unidad">Unidad:</label>
                                        <input class="form-control" type="text" name="unidad" id="unidad" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="id_material">Material</label>
                                        
                                        <select class="form-control" id="id_material" name="id_material">
                                            <option value="" disabled selected>-- Selecciona un material --</option>
                                            <?php foreach ($materiales as $material): ?>
                                                <option 
                                                    value="<?php echo htmlspecialchars($material['id_material']); ?>"
                                                    data-precio="<?php echo htmlspecialchars($material['precio']); ?>"
                                                    data-unidad="<?php echo htmlspecialchars($material['unidad']); ?>"
                                                    data-stock="<?php echo htmlspecialchars($material['stock']); ?>">
                                                    <?php echo htmlspecialchars($material['nombre']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label for="stock">Stock:</label>
                                        <input class="form-control" type="text" name="stock" id="stock" readonly>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label for="cantidad">Cantidad:</label>
                                        <input class="form-control" type="text" name="cantidad" id="cantidad">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-12 text-center">
                                        <input type="hidden" name="detalles" id="detalles_json">
                                        <button id="btnAgregarArt" type="button" class="btn btn-primary">
                                            <span class="fa fa-plus"></span> Agregar 
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <table id="detalles" class="table table-bordered">
                                            <thead style="background-color:#A9D0F5">
                                                <th>COD</th>
                                                <th>DESCRIPCIÓN</th>
                                                <th>STOCK</th>
                                                <th>PRECIO</th>
                                                <th>CANTIDAD</th>
                                                <th>SUBTOTAL</th>
                                                <th>ACCIONES</th>
                                            </thead>
                                            <tfoot>
                                                <th>TOTAL</th>
                                                <th colspan="4"></th>
                                                <th>
                                                    <h4 id="total">Bs. 0.00</h4>
                                                    <input type="hidden" name="total_venta" id="total_venta">
                                                </th>
                                                <th></th>
                                            </tfoot>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>

                                <input type="hidden" name="estado" id="estado" value="1">

                                <div class="row">
                                    <div class="form-group col-lg-12 text-center">
                                        <button class="btn btn-primary" type="submit" id="btnGuardar">
                                            <i class="fa fa-save"></i> Guardar
                                        </button>
                                        <button class="btn btn-danger" onclick="window.location.href='index.php';" type="button" id="btnCancelar">
                                            <i class="fa fa-arrow-circle-left"></i> Cancelar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="../../public/js/venta.js"></script>
