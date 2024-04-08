<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "panaderia";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir el DNI del usuario a eliminar
$id_producto = $_POST['id_producto'];

// Consulta SQL para eliminar el usuario
$sql = "DELETE FROM productos WHERE id_producto='$id_producto'";

if ($conn->query($sql) === TRUE) {
    // Redirigir a la página de confirmación
    header("Location: producto_eliminado.php");
    exit();
} else {
    echo "Error al eliminar usuario: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>