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
$id_categoria = $_POST['id_categoria'];

// Consulta SQL para eliminar el usuario
$sql = "DELETE FROM categorias WHERE id_categoria='$id_categoria'";

if ($conn->query($sql) === TRUE) {
    // Redirigir a la página de confirmación
    header("Location: categoria_eliminada.php");
    exit();
} else {
    echo "Error al eliminar usuario: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>