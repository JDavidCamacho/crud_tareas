<?php
require_once '../../business/VentaService.php';

if (!isset($_GET['id_venta'])) {
    die("ID de venta no proporcionado.");
}

$id_venta = $_GET['id_venta'];
$ventaService = new VentaService();
$comprobante = $ventaService->ObtenerComprobante($id_venta);

if (!$comprobante) {
    die("Venta no encontrada.");
}
?>

<?php include '../Shared/header.php'; ?>
<?php include '../Shared/nav.php'; ?>
<?php include '../Shared/aside.php'; ?>

<style>
    @media print {
        body * {
            visibility: hidden; /* Oculta todos los elementos de la página */
        }

        .comprobante-box, .comprobante-box * {
            visibility: visible; /* Muestra solo el comprobante */
        }

        .comprobante-box {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .no-print {
            display: none; /* Oculta los botones de acción como "Volver" e "Imprimir" */
        }
    }

    .comprobante-box {
        font-family: 'Helvetica Neue', 'Helvetica', Arial, sans-serif;
        color: #333;
        padding: 30px;
    }

    .comprobante-box h1 {
        font-size: 24px;
        margin-bottom: 0;
    }

    .comprobante-box h2 {
        font-size: 18px;
        margin-top: 0;
        color: #666;
    }

    .comprobante-header {
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .comprobante-footer {
        border-top: 2px solid #000;
        margin-top: 20px;
        padding-top: 10px;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }

    .total-box {
        font-size: 18px;
        font-weight: bold;
        color: #000;
        background-color: #f2f2f2;
        padding: 10px;
        border-radius: 4px;
    }

    .logo-img {
        max-height: 70px;
    }
</style>

<div id="page-wrapper">
    <div class="container mt-5 comprobante-box">
        <div class="comprobante-header d-flex justify-content-between align-items-center">
            <div>
                <h1>Comprobante de Venta</h1>
                <h2>N° <?= htmlspecialchars($id_venta) ?></h2>
            </div>
            <div>
                <img src="../../public/img/logo.png" alt="Logo Empresa" class="logo-img">
            </div>
        </div>

        <!-- Datos del Cliente -->
        <div class="row mb-4">
            <div class="col-md-6">
                
                <p><strong>Nombre:</strong> <?= htmlspecialchars($comprobante['cliente']) ?></p>
                <p><strong>Teléfono:</strong> <?= htmlspecialchars($comprobante['telefono']) ?></p>
                <p><strong>Correo:</strong> <?= htmlspecialchars($comprobante['correo']) ?></p>
            </div>
            <div class="col-md-6">
                
                <p><strong>Dirección:</strong> <?= htmlspecialchars($comprobante['direccion']) ?></p>
                <p><strong>Fecha:</strong> <?= htmlspecialchars($comprobante['fecha']) ?></p>
            </div>
        </div>
        <h5 style="text-align: center; font-size: 20px;">Detalles del Comprobante</h5>
        <!-- Tabla Detalles -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Material</th>
                        <th class="text-end">Precio (Bs.)</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-end">Subtotal (Bs.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comprobante['detalles'] as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nombre']) ?></td>
                            <td class="text-end"><?= number_format($item['precio'], 2, ',', '.') ?></td>
                            <td class="text-center"><?= $item['cantidad'] ?></td>
                            <td class="text-end"><?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="row justify-content-end mt-4">
            <div class="col-md-4">
                <div class="total-box">
                    Total a Pagado: Bs. <?= number_format($comprobante['total'], 2, ',', '.') ?>
                </div>
            </div>
        </div>

        <div class="comprobante-footer text-end no-print">
            <a href="index.php" class="btn btn-secondary">Volver a la lista</a>
            <button onclick="window.print()" class="btn btn-primary">Imprimir Comprobante</button>
        </div>
    </div>
</div>
