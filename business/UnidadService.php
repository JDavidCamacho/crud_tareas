<?php
// /negocio/UnidadService.php
require_once __DIR__ . '/../data/UnidadDAO.php';

class UnidadService
{
    private $unidadDAO;

    public function __construct()
    {
        $this->unidadDAO = new UnidadDAO();
    }


    // Método para obtener todos las unidades
    public function GetAllUnidad() 
    {
        return $this->unidadDAO->GetAllUnidad();
    }

  //metodo para crear unidad
  public function CreateUnidad(Unidad $unidad)
  {
      return $this->unidadDAO->CreateUnidad($unidad);
  }

   //editar unidad
   public function UpdateUnidad(Unidad $unidad)
   {
       return $this->unidadDAO->UpdateUnidad($unidad);
   }
  
    
//eliminar unidad
public function DeleteUnidad($unidadId)
{
    return $this->unidadDAO->DeleteUnidad($unidadId);
}
     



    //obtener producto por ID
    public function FindUnidadById($unidadId)
    {
        return $this->unidadDAO->FindUnidadById($unidadId);
    }


//para hacer venta requiero crear un sistema de ventas que tenga venta y reporte de ventas en el lenguaje html y php en el modelo de tres capas[modelo, presentacion,datos]

}
