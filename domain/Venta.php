<?php 

class Venta {
    private $id;
    private $id_cliente;
    
    private $fecha;
    private $total;
    private $estado;

    public function __construct($id_cliente, $fecha,$total,$estado,  $id = null) {
        $this->id = $id;
        $this->id_cliente = $id_cliente;
        $this->fecha = $fecha;
        $this->total = $total;
        $this->estado = $estado;
        $this->estado = $estado;
      
    
    }

    // Getters para cada propiedad
    public function getId() {
        return $this->id;
    }

    public function getIdCliente() {
        return $this->id_cliente;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getEstado() {
        return $this->estado;
    }


    // Setters si son necesarios
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdCliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

   
}
?>
