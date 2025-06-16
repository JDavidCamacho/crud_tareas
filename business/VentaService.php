<?php
// filepath: c:\xampp\htdocs\sistemadeventas\business\VentaService.php

require_once __DIR__ . '/../data/VentaDAO.php'; // Ruta corregida
require_once __DIR__ . '/../domain/Venta.php'; // Asegúrate de incluir la clase Venta

class VentaService
{
    private $ventaDAO;

    public function __construct()
    {
        $this->ventaDAO = new VentaDAO();
    }

    // Método para obtener todas las ventas
    public function GetAllVenta() 
    {
        return $this->ventaDAO->GetAllVenta();
    }

    // Método para insertar una venta (solo cabecera)
    public function InsertarVenta(Venta $venta)
    {
        return $this->ventaDAO->InsertarVenta($venta);
    }

    // Método para registrar una venta completa (con detalles)
    public function RegistrarVentaCompleta(Venta $venta, array $detalles)
    {
        // Se pasa tanto el objeto Venta como los detalles al DAO
        return $this->ventaDAO->InsertarVentaConDetalles($venta, $detalles);
    }

       // Eliminar una venta
       public function DeleteVenta($ventaId)
       {
           return $this->ventaDAO->DeleteVenta($ventaId);
       }

      //comprobante de venta
      public function ObtenerComprobante($id_venta)
      {
          return $this->ventaDAO->ObtenerComprobantePorId($id_venta);
      }
    

}
