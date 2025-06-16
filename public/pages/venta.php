<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí puedes procesar los datos, si es necesario (por ejemplo, guardar en la base de datos o hacer cálculos)
    $material = $_POST['material'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $total = $cantidad * $precio;

    echo "<h2>Detalles de la Venta:</h2>";
    echo "<p><strong>Producto:</strong> " . htmlspecialchars($material) . "</p>";
    echo "<p><strong>Cantidad:</strong> " . htmlspecialchars($cantidad) . "</p>";
    echo "<p><strong>Precio por unidad:</strong> $" . htmlspecialchars($precio) . "</p>";
    echo "<p><strong>Total de la venta:</strong> $" . number_format($total, 2) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            max-width: 300px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Formulario de Venta</h2>
        <form method="POST" action="">
            <label for="material">Material:</label><br>
            <input type="text" id="material" name="material" required><br><br>

            <label for="cantidad">Cantidad:</label><br>
            <input type="number" id="cantidad" name="cantidad" min="1" required><br><br>

            <label for="precio">Precio por unidad:</label><br>
            <input type="number" id="precio" name="precio" step="0.01" min="0" required><br><br>

            <input type="submit" value="Registrar Venta">
        </form>
    </div>

</body>
</html>
