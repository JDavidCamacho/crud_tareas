<?php 

class Proveedor{
    private $id;
    private $razonSocial;
    private $telefono;
    private $direccion;
    private $nit;
    private $correo;
    private $estado;

    public function __construct($razonSocial, $telefono, $direccion, $nit, $correo, $estado, $id=null){
        $this->id = $id;
        $this->razonSocial = $razonSocial;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->nit = $nit;
        $this->correo = $correo;
        $this->estado = $estado;
    }
    public function getId(){
        return $this->id;
    }   
    public function getRazonSocial(){
        return $this->razonSocial;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getNit(){
        return $this->nit;
    }
    public function getCorreo(){
        return $this->correo;
    }
    public function getEstado(){
        return $this->estado;
    }
    // Setters
    public function setId($id){
        $this->id = $id;
    }
    public function setRazonSocial($razonSocial){
        $this->razonSocial = $razonSocial;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setNit($nit){
        $this->nit = $nit;
    }
    public function setCorreo($correo){
        $this->correo = $correo;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }
    

}

?>