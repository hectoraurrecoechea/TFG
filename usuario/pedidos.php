<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../index.php");
    exit;
}

// Verificar si hay productos en el carrito
if (empty($_SESSION['carrito_ids'])) {
    header("location: carrito.php");
    exit;
}

// Establecer la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "12345", "panaderia");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Insertar pedido en la tabla pedidos para cada ID de carrito asociado al usuario
foreach ($_SESSION['carrito_ids'] as $id_carrito) {
    // Insertar pedido en la tabla pedidos
    $fecha_pedido = date("Y-m-d H:i:s");
    $estado_pedido = "pendiente";
    $dni_usuario = $_SESSION['dni'];
    $sql_insert_pedido = "INSERT INTO pedidos (fecha_pedido, estado_pedido,dni) VALUES ('$fecha_pedido', '$estado_pedido','$dni_usuario')";
    
    if ($conexion->query($sql_insert_pedido) === TRUE) {
        // Pedido insertado correctamente
    } else {
        // Error al insertar el pedido, registrar en el archivo de registro
        $error_message = "Error al insertar pedido para el carrito ID: $id_carrito - Error: " . $conexion->error;
        error_log($error_message, 3, "error_log.txt");
    }
}

// Limpiar el carrito después de completar el pedido
$_SESSION['carrito'] = array();
$_SESSION['carrito_ids'] = array();

// Redireccionar a la página de carrito
header("Location: carrito.php");
exit;
?>
