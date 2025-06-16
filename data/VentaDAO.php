<?php
// filepath: c:\xampp\htdocs\sistemadeventas\data\VentaDAO.php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/Venta.php';

class VentaDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    //  Obtener todas las ventas usando procedimiento almacenado
    public function GetAllVenta()
    {
        $query = "CALL GetAllVenta()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ventas = [];

        foreach ($result as $row) {
            $ventas[] = new Venta(
                $row['id_cliente'],
                $row['fecha'],
                $row['total'],
                $row['estado'],
                $row['id_venta']
            );
        }

        return $ventas;
    }

    //  Insertar venta (solo cabecera)
    public function InsertarVenta(Venta $venta)
    {
        $query = "CALL InsertarVenta(:id_cliente, :fecha, :total, :estado)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'id_cliente' => $venta->getIdCliente(),
            'fecha' => $venta->getFecha(),
            'total' => $venta->getTotal(),
            'estado' => $venta->getEstado()
        ]);
    }

    //  Insertar venta con detalles (transacción)
    public function InsertarVentaConDetalles(Venta $venta, array $detalles)
    {
        try {
            $this->conn->beginTransaction();

            // Insertar cabecera
            $stmtVenta = $this->conn->prepare("INSERT INTO venta (id_cliente, fecha, total, estado) VALUES (?, ?, ?, ?)");
            $stmtVenta->execute([
                $venta->getIdCliente(),
                $venta->getFecha(),
                $venta->getTotal(),
                $venta->getEstado(),
                
            ]);

            //obtener el ID de la venta recién insertada
            

            $id_venta = $this->conn->lastInsertId();

            // Insertar detalles y actualizar stock
            $stmtDetalle = $this->conn->prepare("INSERT INTO detalle_venta (id_venta, id_material, cantidad, precio) VALUES (?, ?, ?, ?)");

            $stmtStock = $this->conn->prepare("UPDATE material SET stock = stock - ? WHERE id_material = ?");

            foreach ($detalles as $detalle) {
                $stmtDetalle->execute([$id_venta, $detalle['id_material'], $detalle['cantidad'], $detalle['precio']]);
                $stmtStock->execute([$detalle['cantidad'], $detalle['id_material']]);
            }

            $this->conn->commit();//confirma los cambios realizados durante la transacción de forma permanente en la base de datos
            //si ocurre un error el try catch se encarga de revertir los cambios con rollback
            
            // Devuelve el ID de la venta insertada

            return ['success' => true, 'id_venta' => $id_venta];
        } catch (PDOException $e) {
            $this->conn->rollBack();//revierte todos incluso los cambios realizados en la base de datos
            //maneja errores
            return ['success' => false, 'error' => $e->getMessage()];
        }

    }
 public function DeleteVenta($ventaId)
        {
            $query = "CALL DeleteVenta(:id , :estado)";
            $estado = 0;
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $ventaId, PDO::PARAM_INT);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
            return $stmt->execute(); // devuelve el resultado de la ejecución
        }

//comprobante de venta


public function ObtenerComprobantePorId($id_venta) {
    // Obtener datos de la venta
    $sqlVenta = "SELECT v.fecha, v.total AS total_venta, c.nombre AS cliente, c.telefono, c.correo, c.direccion
                 FROM venta v
                 INNER JOIN clientes c ON v.id_cliente = c.id_cliente
                 WHERE v.id_venta = ?";
    $stmt = $this->conn->prepare($sqlVenta);
    $stmt->execute([$id_venta]);
    $venta = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$venta) return null;

    // Obtener detalles de la venta
    $sqlDetalle = "SELECT m.nombre, dv.precio, dv.cantidad, (dv.precio * dv.cantidad) AS subtotal
                   FROM detalle_venta dv
                   INNER JOIN material m ON dv.id_material = m.id_material
                   WHERE dv.id_venta = ?";
    $stmt = $this->conn->prepare($sqlDetalle);
    $stmt->execute([$id_venta]);
    $detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return [
        'cliente' => $venta['cliente'],
        'telefono' => $venta['telefono'],
        'correo' => $venta['correo'],
        'direccion' => $venta['direccion'],
        'fecha' => $venta['fecha'],
        'total' => $venta['total_venta'],
        'detalles' => $detalles
    ];
}


}
