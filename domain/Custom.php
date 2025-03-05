<?php 

class Custom{
    private $id;
    private $nombre;
    private $apellido; 
    private $email;
    private $direccion;
    private $telefono;


    //a trabajar con constructor que se debe cargar si o si

    public function __construct($nombre, $apellido, $email, $direccion, $telefono, $id=null){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->id = $id;

    }
    //metodos geters para extraer
    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    //metodos para seters

    public function setId($id){
        $this->id=$id;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

}

   

?>