<?php
require_once __DIR__ . '/../data/ProductoDAO.php';

class ProductoService
{
    private $productoDAO;

    public function __construct()
    {
        $this->productoDAO = new ProductoDAO();
    }

    //obtener todo los productos
    public function getAllProductos()
    {
        return $this->productoDAO->getAllProductos();
    }

    //crear producto
    public function createProducto(Producto $producto)
    {
        return $this->productoDAO->createProducto($producto);
    }

    //obtener producto por ID
    public function getProductoById($productoId)
    {
        return $this->productoDAO->findProductoById($productoId);
    }

    //actualizar producto
    public function updateProducto(Producto $producto)
    {
        return $this->productoDAO->updateProducto($producto);
    }

    //eliminar producto
    public function deleteProducto($productoId)
    {
        return $this->productoDAO->deleteProducto($productoId);
    }
}
?>