<?php 


class Rol {
    private $id;
    private $nombre;
    private $descripcion;
    private $estado;

    public function __construct($nombre, $descripcion, $estado, $id = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
    public function getEstado() {
        return $this->estado;
    }
    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
}
?>