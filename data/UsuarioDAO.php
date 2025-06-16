<?php
// /datos/UserDAO.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/User.php';

class UserDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para obtener todos los usuarios
    public function getAllUsers() 
    {
        $query = "CALL GetAllUsers()";
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
            $users[] = new User($row['nombre'],$row['apellido'],$row['usuario'], $row['correo'], $row['password'], $row['estado'], $row['id_usuario']);
        }

        return $users;

        //return $stmt->fetchAll(PDO::FETCH_ASSOC); //devuelve un array asociativo
    }
    
    //Metodo para obtener los datos del usuario para su validacion
    public function getUserByUsername($username)
    {
        $query = "CALL GetUserByUsername(:p_usuario)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':p_usuario', $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new User($result['nombre'],$result['apellido'],$result['usuario'], $result['correo'], $result['password'],$result['estado'], $result['id_usuario']);
        }
        return null;
        //return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    // Metodo para crear el usuario
    public function createUser(User $user) //(user $user)=
    {
        $query = "CALL CreateUser(:nombre, :apellido, :usuario, :correo, :password, :estado)";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            'nombre' => $user->getNombre(),
            'apellido'=> $user->getApellido(),
            'usuario' => $user->getUsuario(), //La variable user que contiene los datos de la clase User recuperamos username
            'correo' => $user->getCorreo(),
            'password' => $user->getPassword(), //La varibale user que contiene los datos de la clase User recuperamos password
            'estado' => $user->getEstado()
        ]);

        /* return $stmt->execute([
            'username' => $username,
            'password' => $password // Enviar la contraseña sin encriptar
        ]); */
    }

    // Encontrar un usuario por su ID usando PDO
    public function findUserById($userId)
    {
        $query = "CALL FindUserById(:id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new User($result['nombre'],$result['apellido'],$result['usuario'], $result['correo'],$result['password'],$result['estado'], $result['id_usuario']);
        }
        return null;

        //return $stmt->fetch(PDO::FETCH_ASSOC); // devuelve un array asociativo
    }

    // Actualizar un usuario en la base de datos usando PDO
   public function updateUser(User $user)
{
    $query = "CALL UpdateUser(:id, :nombre, :apellido, :usuario, :correo, :password, :estado)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $user->getId(), PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $user->getNombre(), PDO::PARAM_STR);
    $stmt->bindParam(':apellido', $user->getApellido(), PDO::PARAM_STR);
    $stmt->bindParam(':usuario', $user->getUsuario(), PDO::PARAM_STR);
    $stmt->bindParam(':correo', $user->getCorreo(), PDO::PARAM_STR);
    $stmt->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
    $stmt->bindParam(':estado', $user->getEstado(), PDO::PARAM_INT);

    return $stmt->execute(); // Devuelve true si la ejecución fue exitosa
}

    // Eliminar un usuario por su ID
    public function deleteUser($userId)
    {
        $query = "CALL DeleteUser(:id_usuario , :estado)";
        $estado = 0;
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        return $stmt->execute(); // devuelve el resultado de la ejecución
    }


















}