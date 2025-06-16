<?php
// /negocio/UnidadService.php
require_once __DIR__ . '/../data/RolDAO.php';

class RolService
{
    private $rolDAO;

    public function __construct()
    {
        $this->rolDAO = new RolDAO();
    }


    // Método para obtener todos las unidades
    public function ObtenerRoles() 
    {
        return $this->rolDAO->ObtenerRoles();
    }
    //metodo para crear rol
    public function CrearRol(Rol $rol)
    {
        return $this->rolDAO->CrearRol($rol);
    }
    //metodo para editar rol
    public function EditarRol(Rol $rol)
    {
        return $this->rolDAO->EditarRol($rol);
    }
    //metodo para buscar id de rol
    public function BuscarRolId($rolId)
    {
        return $this->rolDAO->BuscarRolId($rolId);
    }

  

   
  

     



   


//para hacer venta requiero crear un sistema de ventas que tenga venta y reporte de ventas en el lenguaje html y php en el modelo de tres capas[modelo, presentacion,datos]

}
