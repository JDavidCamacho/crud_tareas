<?php
// /negocio/UserService.php
require_once __DIR__ . '/../data/ProveedorDAO.php';

class ProveedorService
{
    private $proveedorDAO;

    public function __construct()
    {
        $this->proveedorDAO = new ProveedorDAO();
    }


    // Método para obtener todos los clientes
    

    public function ObtenerProveedores()
    {
        return $this->proveedorDAO->ObtenerProveedores();
    }
     // Obtener un proveedor por ID
    public function ObtenerProveedorId($proveedorId)
    {
        return $this->proveedorDAO->ObtenerProveedorId($proveedorId);
    }
    // Método para obtener un proveedor por nombre  

     
   
 

     // Método para crear proveedores
   
     public function CrearProveedor(Proveedor $proveedor)
     {
         return $this->proveedorDAO->CrearProveedor($proveedor);
     }
    

     //editar un proveedor
    public function EditarProveedor(Proveedor $proveedor)
    {
     
        return $this->proveedorDAO->EditarProveedor($proveedor);

     
     }
     // Eliminar un proveedor
    public function EliminarProveedor($proveedorId)
    {
        return $this->proveedorDAO->EliminarProveedor($proveedorId);    


}
}