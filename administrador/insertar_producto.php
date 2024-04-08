<?php
// Procesamiento del formulario de producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "12345", "panaderia");
    
    // Verificar conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
    
    // Preparar la consulta SQL para insertar el producto
    $consulta = "INSERT INTO productos (nombre, descripcion, precio, id_categoria) VALUES (?, ?, ?, ?)";
    
    // Preparar la sentencia
    $sentencia = $conexion->prepare($consulta);
    
    // Vincular parámetros
    $sentencia->bind_param("ssdi", $nombre, $descripcion, $precio, $categoria);
    
    // Ejecutar la sentencia
    $sentencia->execute();
    
    // Verificar si se ha insertado correctamente
    if ($sentencia->affected_rows > 0) {
        echo "Producto agregado correctamente.";
        ?>
        <a href="productos_admin.php">Volver a productos</a>
        <?php
    } else {
        echo "Error al agregar el producto: " . $conexion->error;
    }
    
    // Cerrar conexión
    $conexion->close();
}
?>