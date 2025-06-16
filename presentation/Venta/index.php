
<?php
// Index: Principal
//Llamar a la capa de negocio pero de usuario
require_once '../../business/VentaService.php';

// Instancia de UserService
$ventaService = new VentaService();

// Obtener todos los usuarios
$ventas = $ventaService->GetAllVenta();

//filtrar ventas
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';//el search sirve para mantener el valor de busqueda
if($searchTerm){
    $ventas = array_filter($ventas, function($venta) use ($searchTerm) {//el array filter sirbe para filtrar los clientes
        // busca la posicion de la primera aparicion de una subcadena dentro de una cadena sin importar si es mayuscula o minuscula
        return stripos($venta->getIdCliente(), $searchTerm) !== false || // Filtrar por nombre
                stripos($venta->getFecha(), $searchTerm) !== false|| // Filtrar por fecha
                stripos($venta->getTotal(), $searchTerm) !== false; // Filtrar por total
                
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
                            <h1 class="page-header">LISTA DE VENTAS</h1>
                            <a href="create.php" title="Agregar nueva unidad" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUserModal">nueva venta</a>
                        </div>
                    </div>


                    <form method="POST" class="search-bar mb-3" style="padding-top: 10px;">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Buscar por nombre" value="<?php echo htmlspecialchars($searchTerm); ?>">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>



                    <table class="table table-striped mt-3">
                        <thead>
                        <tr>
                                <th>ID Venta</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventas as $venta): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($venta->getId()); ?></td>
                                    <td><?php echo htmlspecialchars($venta->getIdCliente()); ?></td>
                                    <td><?php echo htmlspecialchars($venta->getFecha()); ?></td>
                                    <td><?php echo htmlspecialchars($venta->getTotal()); ?></td>
                                    <td><?php 
                                        if($venta->getEstado()){
                                            echo htmlspecialchars("venta realizada");
                                        }else{
                                            echo htmlspecialchars("venta cancelada");
                                        }
                                        ?>

                                    </td>
                                   

                                    <td>
                                  
                                        
                                        <a href="delete.php?id=<?php echo htmlspecialchars($venta->getId()); ?>" 
                                        title="Eliminar venta" 
                                        class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta venta?');">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </a>
                                               <!--boton para generar el comprovante-->
                                         <a href="comprobante.php?id_venta=<?php echo htmlspecialchars($venta->getId()); ?>" 
                                            title="ver Comprobante" 
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-print"></i> Comprobante
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