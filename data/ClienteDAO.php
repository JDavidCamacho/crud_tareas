<?php
// /datos/UserDAO.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/Custom.php';

class CustomDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para obtener todos los usuarios
    public function	GetAllCustom() 
    {
        $query = "CALL 	GetAllCustom()";
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
            $users[] = new Custom($row['nombre'], $row['apellido'], $row['email'],$row['direccion'], $row['telefono'], $row['id']);
        }

        return $users;

        //return $stmt->fetchAll(PDO::FETCH_ASSOC); //devuelve un array asociativo
    }
    
    //Metodo para obtener los datos del usuario para su validacion
    public function GetCustomByNombre($nombre)
    {
        $query = "CALL GetCustomByNombre(:p_nombre)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':p_nombre', $nombre);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new Custom($result['nombre'], $result['apellidoi'], $result['email'], $result['direccion'], $result['telefono'], $result['id']);

        }
        return null;
        //return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    // Metodo para crear el usuario
    public function CreateCustom(Custom $custom) //(user $user)=
    {
        $query = "CALL CreateCustom(:nombre, :apellido, :email, :direccion, :telefono)";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            'nombre' => $custom->getNombre(), //La variable user que contiene los datos de la clase Custom recuperamos nombre
            'apellido' => $custom->getApellido(), //La varibale user que contiene los datos de la clase Custom recuperamos apellido
            'email' => $custom->getEmail(), //La varibale user que contiene los datos de la clase Custom recuperamos apellido
            'direccion' => $custom->getDireccion(), //La varibale user que contiene los datos de la clase Custom recuperamos apellido
            'telefono' => $custom->getTelefono() //La varibale user que contiene los datos de la clase Custom recuperamos apellido
        ]);
        
    }



      // Actualizar un usuario en la base de datos usando PDO
      public function UpdateCustom(Custom $custom)
      {
          $query = "CALL UpdateCustom(:id, :nombre, :apellido, :email, :direccion, :telefono)";
          $stmt = $this->conn->prepare($query);
          $stmt->bindParam(':id', $custom->getId(), PDO::PARAM_INT);
          $stmt->bindParam(':nombre', $custom->getNombre(), PDO::PARAM_STR);
          $stmt->bindParam(':apellido', $custom->getApellido(), PDO::PARAM_STR);
          $stmt->bindParam(':email', $custom->getEmail(), PDO::PARAM_STR);
          $stmt->bindParam(':direccion', $custom->getDireccion(), PDO::PARAM_STR);
          $stmt->bindParam(':telefono', $custom->getTelefono(), PDO::PARAM_STR);
  
          return $stmt->execute(); // devuelve el resultado de la ejecución
      }

       // Encontrar un usuario por su ID usando PDO
    public function FindCustomById($customId)
    {
        $query = "CALL FindCustomById(:id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $customId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new Custom($result['nombre'], $result['apellido'], $result['email'],$result['direccion'], $result['telefono'], $result['id']);
        }
        return null;

        //return $stmt->fetch(PDO::FETCH_ASSOC); // devuelve un array asociativo
    }






      // Eliminar un usuario por su ID
      public function DeleteCustom($customId)
      {
          $query = "CALL DeleteCustom(:id)";
          $stmt = $this->conn->prepare($query);
          $stmt->bindParam(':id', $customId, PDO::PARAM_INT);
          return $stmt->execute(); // devuelve el resultado de la ejecución
      }
    

   

    
}