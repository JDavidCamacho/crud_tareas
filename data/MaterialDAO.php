<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/Material.php';

class MaterialDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    //llamar a todos los materiales
    public function GetAllMaterial(){
        $query = "CALL GetAllMaterial()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $materiales = [];

        foreach($result as $row){
            $materiales[] = new Material($row['nombre'], $row['descripcion'], $row['stock'],$row['precio'], $row['imagen'],$row['id_unidad'], $row['estado'], $row['id_material']);
        }

        return $materiales;
    }

    public function GetAllMateriales()
    {
        $query = "SELECT m.id_material, m.nombre, m.precio, u.descripcion AS unidad, m.stock 
                  FROM material AS m 
                  JOIN unidades AS u ON m.id_unidad = u.id_unidad";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //metodo crear material
    public function CreateMaterial(Material $material)
    {
        $query = "CALL CreateMaterial(:nombre, :descripcion, :stock,:precio,  :imagen, :id_unidad, :estado)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'nombre' => $material->getNombre(),
            'descripcion' => $material->getDescripcion(),
            
            'stock' => $material->getStock(),
            'precio' => $material->getPrecio(),
            'imagen' => $material->getImagen(),
            'id_unidad' => $material->getUnidad(),
            'estado' => $material->getEstado()
        ]);
    }

    //busqueda por id
    public function FindMaterialById($materialId)
    {
        $query = "CALL 	FindMaterialById(:id_material)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_material', $materialId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new Material($result['nombre'], $result['descripcion'], $result['stock'],$result['precio'],$result['imagen'], $result['id_unidad'], $result['estado']);
        }
        return null;
    }

    //editar material
    //editar material
   
public function UpdateMaterial(Material $material)
{
    // Validar existencia de la unidad en la tabla `unidades`
    $queryUnidad = "SELECT COUNT(*) FROM unidades WHERE id_unidad = :descripcion";
    $stmtUnidad = $this->conn->prepare($queryUnidad);
    $unidad = $material->getUnidad();
    $stmtUnidad->bindParam(':descripcion', $unidad, PDO::PARAM_STR);
    $stmtUnidad->execute();

    if ($stmtUnidad->fetchColumn() == 0) {
        throw new Exception("Error: La unidad especificada ('{$unidad}') no existe en la tabla 'unidades'.");
    }

    // Proceder con la actualización
    $query = "CALL UpdateMaterial(:id_material, :nombre, :descripcion, :stock, :precio, :imagen, :id_unidad, :estado)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':id_material', $material->getId(), PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $material->getNombre(), PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $material->getDescripcion(), PDO::PARAM_STR);
    $stmt->bindParam(':stock', $material->getStock(), PDO::PARAM_STR);
    $stmt->bindParam(':precio', $material->getPrecio(), PDO::PARAM_STR);
    $stmt->bindParam(':imagen', $material->getImagen(), PDO::PARAM_STR);
    $stmt->bindParam(':id_unidad', $unidad, PDO::PARAM_STR);
    $stmt->bindParam(':estado', $material->getEstado(), PDO::PARAM_STR); // Asegúrate de que el estado sea correcto

    try {
        return $stmt->execute();
    } catch (PDOException $e) {
        throw new Exception("Error al actualizar el material: " . $e->getMessage());
    }
}



    //eliminar material
    public function deleteMaterial($materialId)
    {
        $query = "CALL DeleteMaterial(:id_material)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_material', $materialId, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
?>