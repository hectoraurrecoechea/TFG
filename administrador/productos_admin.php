<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil Administrador</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function eliminarProducto(id_producto) {
            if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
                $.post("eliminar_producto.php", { id_producto: id_producto }, function(response) {
                    let res = JSON.parse(response);
                    alert(res.message);
                    if (res.success) {
                        location.reload();
                    }
                });
            }
        }
    </script>
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

    <?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("location: ../index.php");
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "panaderia";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $consulta = "SELECT p.id_producto, p.nombre AS nombre_producto, p.descripcion, p.precio, c.id_categoria, c.nombre AS nombre_categoria
                 FROM productos p
                 INNER JOIN categorias c ON p.id_categoria = c.id_categoria ORDER BY id_categoria";

    $resultado = $conn->query($consulta);
    ?>

    <h2 class="title">Productos en la base de datos</h2>
    <div class="add-category-container">
        <a href="agregar_producto.php" class="add-category-link">Añadir nuevo producto</a><br><br>
    </div>

    <table>
        <tr>
            <th>id_producto</th>
            <th>Nombre producto</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>id_categoria</th>
            <th>nombre categoria</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_producto"] . "</td>";
                echo "<td>" . $row["nombre_producto"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo "<td>" . $row["precio"] . "</td>";
                echo "<td>" . $row["id_categoria"] . "</td>";
                echo "<td>" . $row["nombre_categoria"] . "</td>";
        ?>
                <td>
                  <form method="get" action="modifica_producto.php">
                    <input type='hidden' name='id_producto' value='<?php echo $row["id_producto"]?>'>
                    <input type='hidden' name='nombre_producto' value='<?php echo $row["nombre_producto"]?>'>
                    <input type='hidden' name='descripcion' value='<?php echo $row["descripcion"]?>'>
                    <input type='hidden' name='precio' value='<?php echo $row["precio"]?>'>
                    <input type='hidden' name='id_categoria' value='<?php echo $row["id_categoria"]?>'>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                  </form>
                </td>
                <td>
                  <button type="button" class="btn btn-danger" onclick="eliminarProducto('<?php echo $row["id_producto"]?>')"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
                </td>
        <?php
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay productos</td></tr>";
        }
        ?>
    </table>

    <?php
    $conn->close();
    ?>
</body>
</html>
