<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil Administrador</title>
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
        <h1>Perfil Administrador</h1>
    </div>
    <div class="nav">
        <a href="usuarios_admin.php">Usuarios</a>
        <a href="categorias_admin.php">Categorías</a>
        <a href="productos_admin.php">Productos</a>
        <a href="pedidos_admin.php">Pedidos</a>
        <a href="cerrarSesion_admin.php">Cerrar sesión</a>
    </div>
    <h1>Listado de Productos</h1>
    <table>
        <tr>
            <th>ID Pedido</th>
            <th>Fecha del Pedido</th>
            <th>Estado del Pedido</th>
            <th>ID Producto</th>
            <th>Cantidad</th>
            <th>Nombre del Producto</th>
            <th>DNI del Cliente</th>
            <th>Correo del Cliente</th>
            <th>Teléfono del Cliente</th>
            <th>Nombre del Cliente</th>
        </tr>
        <?php
        session_start();
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header("location: ../index.php");
            exit;
            //AÑADIR TIEMPO DE SESION PARA INICIAR Y ACABAR LA SESION
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

        // Consulta SQL para obtener los datos
        $sql = "SELECT pedidos.id_pedido, pedidos.fecha_pedido, pedidos.estado_pedido, 
                pedidos_productos.id_producto, pedidos_productos.cantidad, 
                productos.nombre AS nombre_producto, 
                clientes.dni, clientes.correo, clientes.telefono, 
                CONCAT(clientes.nombre, ' ', clientes.apellido1) AS nombre_cliente
                FROM pedidos
                INNER JOIN pedidos_productos ON pedidos.id_pedido = pedidos_productos.id_pedido
                INNER JOIN productos ON pedidos_productos.id_producto = productos.id_producto
                INNER JOIN clientes ON pedidos.dni = clientes.dni";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar datos
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["id_pedido"]."</td>
                        <td>".$row["fecha_pedido"]."</td>
                        <td>".$row["estado_pedido"]."</td>
                        <td>".$row["id_producto"]."</td>
                        <td>".$row["cantidad"]."</td>
                        <td>".$row["nombre_producto"]."</td>
                        <td>".$row["dni"]."</td>
                        <td>".$row["correo"]."</td>
                        <td>".$row["telefono"]."</td>
                        <td>".$row["nombre_cliente"]."</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No se encontraron resultados.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </table>
</body>
</html>
