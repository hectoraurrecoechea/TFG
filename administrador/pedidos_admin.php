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
        /* Estilos para los diferentes estados de pedido */
        .rojo {
            background-color: red;
        }
        .naranja {
            background-color: orange;
        }
        .verde {
            background-color: green;
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
    <h1>Listado de Pedidos</h1>
    <table>
        <tr>
            <th>ID Pedido</th>
            <th>Fecha del Pedido</th>
            <th>Estado del Pedido</th>
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
        $sql = "SELECT id_pedido, fecha_pedido, estado_pedido FROM pedidos";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar datos
            while ($row = $result->fetch_assoc()) {
                // Determinar la clase CSS basada en el estado del pedido
                $clase_estado = '';
                switch ($row["estado_pedido"]) {
                    case 0:
                        $clase_estado = 'rojo';
                        break;
                    case 1:
                        $clase_estado = 'naranja';
                        break;
                    case 2:
                        $clase_estado = 'verde';
                        break;
                }

                // Imprimir la fila de la tabla con la clase CSS correspondiente
                echo "<tr class='$clase_estado'>
                        <td>".$row["id_pedido"]."</td>
                        <td>".$row["fecha_pedido"]."</td>
                        <td>
                            <form method='post' action='actualizar_estado_pedido.php'>
                                <input type='hidden' name='id_pedido' value='".$row["id_pedido"]."'>
                                <select name='estado_pedido'>
                                    <option value='0' ".($row["estado_pedido"] == 0 ? "selected" : "").">No realizado</option>
                                    <option value='1' ".($row["estado_pedido"] == 1 ? "selected" : "").">En proceso</option>
                                    <option value='2' ".($row["estado_pedido"] == 2 ? "selected" : "").">Finalizado</option>
                                </select>
                                <input type='submit' value='Actualizar'>
                            </form>
                        </td>

                        <td><a href='mas_informacion.php?id_pedido=".$row["id_pedido"]."'>Más</a></td>
                      </tr>";
            }
            
        } else {
            echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    
</body>
</html>
