<?php 

class Custom{
    private $id;
    private $nombre;
    private $apellido; 
    private $correo;
    private $direccion;
    private $telefono;
    private $estado;


    //a trabajar con constructor que se debe cargar si o si

    public function __construct($nombre, $apellido, $correo, $direccion, $telefono,$estado, $id=null){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->estado = $estado;
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

    public function getCorreo(){
        return $this->correo;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getTelefono(){
        return $this->telefono;
    }
    public function getEstado(){
        return $this->estado;
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

    public function setCorreo($correo){
        $this->correo = $correo;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }

}

   

?>