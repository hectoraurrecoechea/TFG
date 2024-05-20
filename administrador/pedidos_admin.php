<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil Administrador</title>
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
        h1{
            text-align:center;
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

    <!-- Agrega el desplegable de filtrado -->
    <div style="text-align: center; margin-bottom: 20px;">
    <form action="pedidos_admin.php" method="POST" style="display: inline-block; padding: 10px; background-color: #f2f2f2; border-radius: 5px;">
        <select name="filtro_estado" style="padding: 5px;">
            <option value="todas" <?php if(isset($_POST['filtro_estado']) && $_POST['filtro_estado'] == 'todas') echo 'selected'; ?>>Todas</option>
            <option value="no_realizado" <?php if(isset($_POST['filtro_estado']) && $_POST['filtro_estado'] == 'no_realizado') echo 'selected'; ?>>No realizado</option>
            <option value="en_proceso" <?php if(isset($_POST['filtro_estado']) && $_POST['filtro_estado'] == 'en_proceso') echo 'selected'; ?>>En proceso</option>
            <option value="finalizado" <?php if(isset($_POST['filtro_estado']) && $_POST['filtro_estado'] == 'finalizado') echo 'selected'; ?>>Finalizado</option>
        </select>
        <input type="submit" value="Filtrar" style="padding: 5px;">
    </form>
</div>

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

        // Consulta SQL para obtener los datos con filtro opcional
        $filtro = "";
        if (isset($_POST['filtro_estado'])) {
            switch ($_POST['filtro_estado']) {
                case 'no_realizado':
                    $filtro = " WHERE estado_pedido = 0";
                    break;
                case 'en_proceso':
                    $filtro = " WHERE estado_pedido = 1";
                    break;
                case 'finalizado':
                    $filtro = " WHERE estado_pedido = 2";
                    break;
                default:
                    // Para el filtro "Todas", no necesitamos agregar ninguna condición
                    break;
            }
        }
        $sql = "SELECT id_pedido, fecha_pedido, estado_pedido FROM pedidos" . $filtro . " ORDER BY id_pedido desc";

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
