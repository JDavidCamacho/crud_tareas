<?php
class Material{
    private $id;
    private $nombre;
    private $descripcion;

    private $stock;
    private $precio;
    
    private $imagen;
    private $unidad;
    private $estado;

    public function __construct($nombre, $descripcion, $stock,$precio,  $imagen, $unidad, $estado,  $id=null){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->imagen = $imagen;
        $this->unidad = $unidad;
        $this->estado = $estado;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }
    
    public function getStock(){
        return $this->stock;
    }
    public function getPrecio(){
        return $this->precio;
    }

    
    public function getImagen(){
        return $this->imagen;
    }

    public function getUnidad(){
        return $this->unidad;
    }
    public function getEstado(){
        return $this->estado;
    }



    //metodos set
    public function setId($id){
        $this->id = $id;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
  

    public function setStock($stock){
        $this->stock = $stock;
    }
    public function setPrecio($precio){
        $this->precio = $precio;
    }
    

    public function setImagen($imagen){
        $this->imagen = $imagen;
    }
    
    public function setUnidad($unidad){
        $this->unidad = $unidad;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

}
?>