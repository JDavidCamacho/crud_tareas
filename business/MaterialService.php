<?php
require_once __DIR__ . '/../data/MaterialDAO.php';

class MaterialService
{
    private $materialDAO;

    public function __construct()
    {
        $this->materialDAO = new MaterialDAO();
    }

    //obtener todo los materiales
    public function GetAllMaterial()
    {
        return $this->materialDAO->GetAllMaterial();
    }

//obtener materiales para el listado
    public function GetAllMateriales(){
        return $this->materialDAO->GetAllMateriales();
    }

    //crear producto
    public function CreateMaterial(Material $material)
    {
        return $this->materialDAO->CreateMaterial($material);
    }

    //obtener producto por ID
    public function FindMaterialById($materialId)
    {
        return $this->materialDAO->FindMaterialById($materialId);
    }

    //editar material
    public function UpdateMaterial(Material $material)
    {
        return $this->materialDAO->UpdateMaterial($material);
    }

    //eliminar producto
    public function deleteMaterial($materialId)
    {
        return $this->materialDAO->deleteMaterial($materialId);
    }
}
?>