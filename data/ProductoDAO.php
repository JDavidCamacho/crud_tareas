<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/Producto.php';

class ProductoDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    //llamar a todos los productos
    public function getAllProductos(){
        $query = "CALL GetAllProductos()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productos = [];

        foreach($result as $row){
            $productos[] = new Producto($row['nombre'], $row['descripcion'], $row['precio'], $row['imagen'], $row['id']);
        }

        return $productos;
    }

    //metodo crear producto
    public function createProducto(Producto $producto)
    {
        $query = "CALL CreateProducto(:nombre, :descripcion, :precio, :imagen)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            'nombre' => $producto->getNombre(),
            'descripcion' => $producto->getDescripcion(),
            'precio' => $producto->getPrecio(),
            'imagen' => $producto->getImagen()
        ]);
    }

    //busqueda por id
    public function findProductoById($productoId)
    {
        $query = "CALL findProductoById(:id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $productoId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new Producto($result['nombre'], $result['descripcion'], $result['precio'], $result['imagen']);
        }
        return null;
    }

    //actualizar producto
    public function updateProducto(Producto $producto)
    {
        $query = "CALL UpdateProducto(:id, :nombre, :descripcion, :precio, :imagen)";
        $stmt = $this->conn->prepare($query);

        $id = $producto->getId();
        $nombre = $producto->getNombre();
        $descripcion = $producto->getDescripcion();
        $precio = $producto->getPrecio();
        $imagen = $producto->getImagen();

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_STR);

        var_dump($query, [
            'id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'imagen' => $imagen,
        ]);

        return $stmt->execute();
    }

    //borrar producto
    public function deleteProducto($productoId)
    {
        $query = "CALL DeleteProducto(:id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $productoId, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
?>