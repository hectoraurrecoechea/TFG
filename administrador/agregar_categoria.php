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

    // Insertar la categoría en la base de datos
    $sql = "INSERT INTO categorias (nombre, descripcion) VALUES ('$nombre', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        echo "Categoría añadida correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Categoría</title>
</head>
<body>
    <h1>Agregar Nueva Categoría</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="nombre">Nombre de la Categoría:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="descripcion">Descripción de la Categoría:</label><br>
        <textarea id="descripcion" name="descripcion" cols="50" rows="10" required></textarea><br><br>
        <input type="submit" value="Añadir Categoría">
    </form>
    <a href="categorias_admin.php">Volver</a>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>