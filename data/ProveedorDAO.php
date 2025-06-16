<?php
// /datos/UserDAO.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/Proveedor.php';

class ProveedorDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    // public function ObtenerProveedores()
    // {
    //     $query = "SELECT id_proveedor, razon_social FROM proveedores";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();

    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    // Método para obtener todos los clientes
    public function	ObtenerProveedores() 
    {
        $query = "CALL 	ObtenerProveedores()";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
     
        $proveedores = [];
        
        foreach($resultado as $row){
       
         $proveedores[] = new Proveedor($row['razon_social'], $row['telefono'], $row['direccion'], $row['nit_ci'], $row['correo'], $row['estado'], $row['id_proveedor']
        );
        }

        return $proveedores;

        //return $stmt->fetchAll(PDO::FETCH_ASSOC); //devuelve un array asociativo
    }
    // Método para obtener un proveedor por ID
    public function ObtenerProveedorId($proveedorId)
    {
        $query = "CALL ObtenerProveedorId(:id_proveedor)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_proveedor', $proveedorId, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Proveedor($row['razon_social'], $row['telefono'], $row['direccion'], $row['nit_ci'], $row['correo'], $row['estado'], $row['id_proveedor']);
        }
        return null; // Si no se encuentra el proveedor
    }
  
    // Método para crear proveedores
    public function CrearProveedor(Proveedor $proveedor)
    {
        $query = "CALL CrearProveedor(:razon_social, :telefono, :direccion, :nit_ci, :correo, :estado)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'razon_social' => $proveedor->getRazonSocial(),
            'telefono' => $proveedor->getTelefono(),
            'direccion' => $proveedor->getDireccion(),
            'nit_ci' => $proveedor->getNit(),
            'correo' => $proveedor->getCorreo(),
            'estado' => $proveedor->getEstado()
        ]);
    }
    // editar un proveedor
    public function EditarProveedor(Proveedor $proveedor)
    {
        $query = "CALL EditarProveedor(:id_proveedor, :razon_social, :telefono, :direccion, :nit_ci, :correo, :estado)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_proveedor', $proveedor->getId(), PDO::PARAM_INT);
        $stmt->bindParam(':razon_social', $proveedor->getRazonSocial(), PDO::PARAM_STR);    
        $stmt->bindParam(':telefono', $proveedor->getTelefono(), PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $proveedor->getDireccion(), PDO::PARAM_STR);
        $stmt->bindParam(':nit_ci', $proveedor->getNit(), PDO::PARAM_STR);
        $stmt->bindParam(':correo', $proveedor->getCorreo(), PDO::PARAM_STR);
        $stmt->bindParam(':estado', $proveedor->getEstado(), PDO::PARAM_STR);
        return $stmt->execute(); // devuelve el resultado de la ejecución
    }

    // Método para eliminar un proveedor
    public function EliminarProveedor($proveedorId)
    {
        $query = "CALL EliminarProveedor(:id_proveedor, :estado)";
        $estado = 0; // Estado para indicar eliminación lógica
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_proveedor', $proveedorId, PDO::PARAM_INT);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        return $stmt->execute(); // devuelve el resultado de la ejecución
    }
    
  
    



     

     






   

   

    
}