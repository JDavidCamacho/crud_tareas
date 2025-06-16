<?php
// /datos/UserDAO.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/Rol.php';

class RolDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para obtener todos los clientes
    public function	ObtenerRoles() 
    {
        $query = "CALL 	ObtenerRoles()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        //creacion de variable para obtener el resultado
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //nuevo codigo 28/10
        //se crea un array para obtener los resultados
        $roles = [];
        
        //con foreach recorremos los resultados obtenidos y los recorremos por fila con la variable row
        foreach($result as $row){
            //la variable users almacena en forma de array los distintos usuarios
            //los cuales son creados con la clase User creado en la carpeta domain
            //para crear con la clase User enviamos parametros necesarios para crear los objetos
        
         $roles[] = new Rol($row['nombre'],$row['descripcion'],  $row['estado'], $row['id_rol']
        );
        }

        return $roles;

        
    }
    // Método para crear un nuevo rol
    public function CrearRol(Rol $rol)
    {
        $query = "CALL CrearRol(:nombre, :descripcion, :estado)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $rol->getNombre(), PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $rol->getDescripcion(), PDO::PARAM_STR);
        $stmt->bindParam(':estado', $rol->getEstado(), PDO::PARAM_INT);

        return $stmt->execute();
    }
    // Método para editar un rol existente
    public function EditarRol(Rol $rol)
    {
        $query = "CALL EditarRol(:id, :nombre, :descripcion, :estado)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $rol->getId(), PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $rol->getNombre(), PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $rol->getDescripcion(), PDO::PARAM_STR);
        $stmt->bindParam(':estado', $rol->getEstado(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Método para buscar un rol por su ID
    public function BuscarRolId($rolId)
    {
        $query = "CALL BuscarRolId(:id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $rolId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new Rol($result['nombre'], $result['descripcion'], $result['estado'], $result['id_rol']);
        }
        return null;
    }
 




  
 

      

     





    

   

    
}