<?php
class User{
    private $id;
    private $nombre;
    private $apellido;
    private $usuario;
    private $correo;
    private $password;
    private $estado;


    //al trabajar con constructor se debe de cargar si o si
    public function __construct( $nombre, $apellido, $usuario, $correo, $password, $estado, $id=null){ 
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->usuario = $usuario;
        $this->correo = $correo;
        $this->password = $password;
        $this->estado = $estado;
    }

    //metodos Getters para extraer
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function getCorreo(){
        return $this->correo;
    }

    public function getPassword(){
        return $this->password;
    }
    public function getEstado(){
        return $this->estado;
    }

    //Setters para poner datos
    public function setId($id){
        $this->id = $id;
    }
   public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    public function setUsuario($usuario){
        $this->usuario= $usuario;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }
};
?>