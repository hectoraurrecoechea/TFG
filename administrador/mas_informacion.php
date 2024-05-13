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

    // Consulta SQL para obtener información del cliente
    $cliente_query = "SELECT c.correo, c.nombre, c.apellido1, c.apellido2, c.telefono
                      FROM clientes c
                      INNER JOIN pedidos p ON c.dni = p.dni
                      WHERE p.id_pedido = $id_pedido";

    $cliente_result = $conn->query($cliente_query);

    // Consulta SQL para obtener detalles del pedido
    $pedido_query = "SELECT pr.nombre, pr.descripcion, pp.cantidad
                     FROM pedidos_productos pp
                     INNER JOIN productos pr ON pp.id_producto = pr.id_producto
                     WHERE pp.id_pedido = $id_pedido";

    $pedido_result = $conn->query($pedido_query);
} else {
    echo "ID de pedido no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Más Información del Pedido</title>
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
        <a href="pedidos_admin.php">Volver a Pedidos</a>
        <a href="cerrarSesion_admin.php">Cerrar sesión</a>
    </div>

    <h2>Información del Cliente</h2>
    <table>
        <tr>
            <th>Correo</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
        </tr>
        <?php
        if ($cliente_result->num_rows > 0) {
            $cliente_row = $cliente_result->fetch_assoc();
            echo "<tr>
                    <td>".$cliente_row["correo"]."</td>
                    <td>".$cliente_row["nombre"]."</td>
                    <td>".$cliente_row["apellido1"]." ".$cliente_row["apellido2"]."</td>
                    <td>".$cliente_row["telefono"]."</td>
                </tr>";
        } else {
            echo "<tr><td colspan='4'>No se encontraron resultados.</td></tr>";
        }
        ?>
    </table>

    <h2>Detalles del Pedido</h2>
    <table>
        <tr>
            <th>Nombre del Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
        </tr>
        <?php
        if ($pedido_result->num_rows > 0) {
            while ($pedido_row = $pedido_result->fetch_assoc()) {
                echo "<tr>
                        <td>".$pedido_row["nombre"]."</td>
                        <td>".$pedido_row["descripcion"]."</td>
                        <td>".$pedido_row["cantidad"]."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Cerrar conexión a la base de datos
$conn->close();
?>
