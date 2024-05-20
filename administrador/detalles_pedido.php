<?php
session_start();

// Verificar si el usuario está logueado como administrador
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['rol'] !== 'administrador') {
    header("location: ../index.php");
    exit;
}

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

// Obtener el ID del pedido desde la URL
if(isset($_GET['id_pedido'])) {
    $id_pedido = $_GET['id_pedido'];

    // Consulta SQL para obtener los detalles del pedido
    $detalles_query = "SELECT pr.nombre, pr.descripcion, pr.precio, pp.cantidad
                       FROM pedidos_productos pp
                       INNER JOIN productos pr ON pp.id_producto = pr.id_producto
                       WHERE pp.id_pedido = $id_pedido";
    $detalles_result = $conn->query($detalles_query);

    // Obtener la fecha y el estado del pedido
    $pedido_info_query = "SELECT fecha_pedido, estado_pedido FROM pedidos WHERE id_pedido = $id_pedido";
    $pedido_info_result = $conn->query($pedido_info_query);
    $pedido_info_row = $pedido_info_result->fetch_assoc();
    $fecha_pedido = $pedido_info_row['fecha_pedido'];
    $estado_pedido = $pedido_info_row['estado_pedido'];
} else {
    echo "ID de pedido no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Pedido</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Detalles del Pedido</h1>
    </div>
    <div class="nav">
        <a href="usuarios_admin.php">Volver a Usuarios</a>
        <a href="cerrarSesion_admin.php">Cerrar sesión</a>
    </div>

    <h2>Información del Pedido</h2>
    <p>Fecha del Pedido: <?php echo $fecha_pedido; ?></p>
    <p>Estado del Pedido: <?php echo $estado_pedido; ?></p>

    <h2>Detalles del Pedido</h2>
    <table>
        <tr>
            <th>Nombre del Producto</th>
            <th>Descripción</th>
            <th>Precio Unitario (€)</th>
            <th>Cantidad</th>
            <th>Total (€)</th>
        </tr>
        <?php
        $total_pedido = 0;
        if ($detalles_result->num_rows > 0) {
            while ($detalles_row = $detalles_result->fetch_assoc()) {
                $nombre_producto = $detalles_row["nombre"];
                $descripcion_producto = $detalles_row["descripcion"];
                $precio_unitario = $detalles_row["precio"];
                $cantidad = $detalles_row["cantidad"];
                $total_producto = $precio_unitario * $cantidad;
                $total_pedido += $total_producto;

                echo "<tr>
                        <td>".$nombre_producto."</td>
                        <td>".$descripcion_producto."</td>
                        <td>".$precio_unitario."</td>
                        <td>".$cantidad."</td>
                        <td>".$total_producto."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron detalles para este pedido.</td></tr>";
        }
        ?>
        <tr>
            <th colspan="4">Total del Pedido (€)</th>
            <td><?php echo $total_pedido; ?></td>
        </tr>
    </table>
</body>
</html>

<?php
// Cerrar conexión a la base de datos
$conn->close();
?>
