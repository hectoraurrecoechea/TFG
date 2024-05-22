<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'No hay sesión iniciada.']);
    exit;
}

$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "panaderia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión.']);
    exit;
}

$id_categoria = $_POST['id_categoria'];

$sql = "DELETE FROM categorias WHERE id_categoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_categoria);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Categoría eliminada correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar la categoría.']);
}

$stmt->close();
$conn->close();
?>
