<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "12345";
$database = "panaderia";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $categoria = $_POST["categoria"];

    // Insertar el producto en la base de datos
    $sql = "INSERT INTO productos (nombre, descripcion, precio, id_categoria) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $categoria);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Producto añadido correctamente.');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="estilosAnadir.css">
</head>
<body>
    <div class="form-container">
        <h1>Agregar Producto</h1>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>
            
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion" cols="50" rows="10" required></textarea><br><br>
            
            <label for="precio">Precio:</label><br>
            <input type="number" id="precio" name="precio" step="0.01" min="0" placeholder="0.00" oninput="validarPrecio(this)" required><br><br>
            <script>
            function validarPrecio(input) {
                if (input.value < 0) {
                    input.setCustomValidity('El precio no puede ser negativo');
                } else {
                    input.setCustomValidity('');
                }
            }
            </script>
            
            <label for="categoria">Categoría:</label><br>
            <select id="categoria" name="categoria" required>
                <?php
                // Consultar las categorías
                $consulta = "SELECT id_categoria, nombre FROM categorias";
                $resultado = $conn->query($consulta);
                
                // Iterar sobre los resultados y mostrar opciones de categoría
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<option value=\"" . $fila['id_categoria'] . "\">" . $fila['nombre'] . "</option>";
                }
                ?>
            </select><br><br>
            
            <input type="submit" value="Agregar Producto">
        </form>
        <a href="productos_admin.php">Volver</a>
    </div>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
