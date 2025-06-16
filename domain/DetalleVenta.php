<?php

class DetalleVenta
{
    private $idMaterial;
    private $cantidad;
    private $precio;

    public function __construct($idMaterial, $cantidad, $precio)
    {
        $this->idMaterial = $idMaterial;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
    }

    public function getIdMaterial()
    {
        return $this->idMaterial;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getPrecio()
    {
        return $this->precio;
    }
}