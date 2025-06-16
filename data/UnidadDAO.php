<?php
// /datos/UserDAO.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/Unidad.php';

class UnidadDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para obtener todos los clientes
    public function	GetAllUnidad() 
    {
        $query = "CALL 	GetAllUnidad()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        //creacion de variable para obtener el resultado
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //nuevo codigo 28/10
        //se crea un array para obtener los resultados
        $users = [];
        
        //con foreach recorremos los resultados obtenidos y los recorremos por fila con la variable row
        foreach($result as $row){
            //la variable users almacena en forma de array los distintos usuarios
            //los cuales son creados con la clase User creado en la carpeta domain
            //para crear con la clase User enviamos parametros necesarios para crear los objetos
        
         $users[] = new Unidad($row['descripcion'], $row['abreviatura'], $row['estado'], $row['id_unidad']
        );
        }

        return $users;

        
    }

 // Encontrar una unidad por su ID usando PDO
 public function FindUnidadById($unidadId)
 {
     $query = "CALL FindUnidadById(:id)";
     $stmt = $this->conn->prepare($query);
     $stmt->bindParam(':id', $unidadId, PDO::PARAM_INT);
     $stmt->execute();

     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     if($result){
         return new Unidad($result['descripcion'],$result['abreviatura'],$result['estado'], $result['id_unidad']);
     }
     return null;

     //return $stmt->fetch(PDO::FETCH_ASSOC); // devuelve un array asociativo
 }

//metodo editar unidad
    public function UpdateUnidad(Unidad $unidad)
    {
        $query = "CALL UpdateUnidad(:id, :descripcion, :abreviatura, :estado )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $unidad->getId(), PDO::PARAM_INT);
        $stmt->bindParam(':descripcion', $unidad->getDescripcion(), PDO::PARAM_STR);
        $stmt->bindParam(':abreviatura', $unidad->getAbreviatura(), PDO::PARAM_STR);
        $stmt->bindParam(':estado', $unidad->getEstado(), PDO::PARAM_STR);

        return $stmt->execute(); // devuelve el resultado de la ejecución
    }

  
  //metodo para crear las unidades
  public function createUnidad(Unidad $unidad)
  {
      $query = "CALL CreateUnidad(:descripcion, :abreviatura, :estado)";
      $stmt = $this->conn->prepare($query);

      return $stmt->execute([
         
          'descripcion' => $unidad->getDescripcion(),
          'abreviatura' => $unidad->getAbreviatura(),
          'estado' => $unidad->getEstado()
      ]);
  }
  
 //eliminar unidad
 public function DeleteUnidad($unidadId)
 {
     $query = "CALL DeleteUnidad(:id , :estado)";
     $estado = 0;
     $stmt = $this->conn->prepare($query);
     $stmt->bindParam(':id', $unidadId, PDO::PARAM_INT);
     $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
     return $stmt->execute(); // devuelve el resultado de la ejecución
 }

 //editar unidad
 

      

     





    

   

    
}