<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
</head>
<body>
    <h2>Agregar Producto</h2>
    <form action="insertar_producto.php" method="POST">

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br>
        
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" cols="50" rows="10"></textarea><br><br>
        
        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio" step="0.01" placeholder="0.00">
        
        <label for="categoria">Categoría:</label><br>
        <select id="categoria" name="categoria">
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli("localhost", "root", "12345", "panaderia");
            
            // Verificar conexión
            if ($conexion->connect_error) {
                die("Error en la conexión: " . $conexion->connect_error);
            }
            
            // Consultar las categorías
            $consulta = "SELECT id_categoria, nombre FROM categorias";
            $resultado = $conexion->query($consulta);
            
            // Iterar sobre los resultados y mostrar opciones de categoría
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value=\"" . $fila['id_categoria'] . "\">" . $fila['nombre'] . "</option>";
            }
            
            // Cerrar conexión
            $conexion->close();
            ?>
        </select><br>
        
        <input type="submit" value="Agregar Producto">
    </form>
</body>
</html>


