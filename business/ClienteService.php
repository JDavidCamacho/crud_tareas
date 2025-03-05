<?php
// /negocio/UserService.php
require_once __DIR__ . '/../data/ClienteDAO.php';

class CustomService
{
    private $customDAO;

    public function __construct()
    {
        $this->customDAO = new CustomDAO();
    }


    // Método para obtener todos los clientes
    public function GetAllCustom() 
    {
        return $this->customDAO->GetAllCustom();
    }


     // Obtener un usuario por ID
     public function GetCustomByNombre($customId)
     {
         return $this->customDAO->FindCustomById($customId);
     }
 

     // Método para crear cliemntes
     public function CreateCustom(Custom $custom)
     {
         return $this->customDAO->CreateCustom($custom);
     }

        // Actualizar un cliente
    public function UpdateCustom(Custom $custom)
    {
        // Validaciones básicas (puedes añadir más validaciones según sea necesario)
        /* if (empty($username) || empty($password)) {
            return false;
        }*/
        // Cifrar la contraseña antes de guardarla
        //$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        return $this->customDAO->CreateCustom($custom);
    }



     // Eliminar un usuario
    public function DeleteCustom($customId)
    {
        return $this->customDAO->DeleteCustom($customId);
    }

}
