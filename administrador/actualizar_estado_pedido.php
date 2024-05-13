<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar la solicitud de actualización del estado del pedido

    // Obtener la información del formulario
    $id_pedido = $_POST['id_pedido'];
    $estado_pedido = $_POST['estado_pedido'];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "panaderia";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Actualizar el estado del pedido en la base de datos
    $sql = "UPDATE pedidos SET estado_pedido = $estado_pedido WHERE id_pedido = $id_pedido";

    if ($conn->query($sql) === TRUE) {
        // Redireccionar de vuelta a pedidos_admin.php
        header("location: pedidos_admin.php");
        exit;
    } else {
        echo "Error al actualizar el estado del pedido: " . $conn->error;
    }

    $conn->close();
}
?>
