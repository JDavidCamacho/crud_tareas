<?php
class Unidad{
    private $id;
    private $descripcion;
    private $abreviatura;
    private $estado;


    //al trabajar con constructor se debe de cargar si o si
    public function __construct($descripcion, $abreviatura, $estado, $id=null){
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->abreviatura = $abreviatura;
        $this->estado = $estado;
    }

    //metodos Getters para extraer
    public function getId(){
        return $this->id;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }
    public function getAbreviatura(){
        return $this->abreviatura;
    }

    public function getEstado(){
        return $this->estado;
    }

    //Setters para poner datos
    public function setId($id){
        $this->id = $id;
    }

    public function setDescripcion($descripcion){
        $this->descripcion= $descripcion;
    }

    public function setAbreviatiura($abreviatura){
        $this->abreviatura = $abreviatura;
    }
    
    public function setEstado($estado){
        $this->estado = $estado;
    }
};
?>