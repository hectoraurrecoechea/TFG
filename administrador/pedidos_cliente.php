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

// Obtener el ID del cliente desde la URL
if(isset($_GET['dni'])) {
    $dni_cliente = $_GET['dni'];

    // Consulta SQL para obtener los pedidos del cliente
    $pedidos_query = "SELECT * FROM pedidos WHERE dni = '$dni_cliente'";
    $pedidos_result = $conn->query($pedidos_query);
} else {
    echo "DNI de cliente no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos del Cliente</title>
    <link rel="stylesheet" href="estilos.css">
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
        /* Estilos condicionales para filas */
        .no-realizado {
            background-color: red;
        }
        .en-proceso {
            background-color: orange;
        }
        .finalizado {
            background-color: green;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pedidos del Cliente</h1>
    </div>
    <div class="nav">
        <a href="usuarios_admin.php">Volver a Usuarios</a>
        <a href="cerrarSesion_admin.php">Cerrar sesión</a>
    </div>

    <h2>Pedidos del Cliente</h2>
    <table>
        <tr>
            <th>Fecha del Pedido</th>
            <th>Estado del Pedido</th>
            <th>Detalles</th>
        </tr>
        <?php
        if ($pedidos_result->num_rows > 0) {
            while ($pedido_row = $pedidos_result->fetch_assoc()) {
                $estado_pedido_texto = '';
                switch ($pedido_row["estado_pedido"]) {
                    case 0:
                        $estado_pedido_texto = 'No Realizado';
                        $clase_estado = 'no-realizado';
                        break;
                    case 1:
                        $estado_pedido_texto = 'En Proceso';
                        $clase_estado = 'en-proceso';
                        break;
                    case 2:
                        $estado_pedido_texto = 'Finalizado';
                        $clase_estado = 'finalizado';
                        break;
                    default:
                        $estado_pedido_texto = 'Desconocido';
                        $clase_estado = '';
                        break;
                }
                echo "<tr class='$clase_estado'>
                        <td>".$pedido_row["fecha_pedido"]."</td>
                        <td>".$estado_pedido_texto."</td>
                        <td><a href='detalles_pedido.php?id_pedido=".$pedido_row["id_pedido"]."'>Más</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No se encontraron pedidos para este cliente.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Cerrar conexión a la base de datos
$conn->close();
?>
