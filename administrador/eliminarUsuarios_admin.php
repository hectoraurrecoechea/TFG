<?php
// eliminar_usuario.php

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

$dni = $_POST['dni'];

$sql = "DELETE FROM clientes WHERE dni = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $dni);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Usuario eliminado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el usuario.']);
}

$stmt->close();
$conn->close();
?>
