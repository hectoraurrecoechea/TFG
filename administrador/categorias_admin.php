<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil Administrador</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function eliminarCategoria(id_categoria) {
            if (confirm("¿Estás seguro de que deseas eliminar esta categoría?")) {
                $.post("eliminar_categoria.php", { id_categoria: id_categoria }, function(response) {
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

    $sql = "SELECT * FROM categorias";
    $result = $conn->query($sql);
    ?>

    <h2 class="title">Categorías en la base de datos</h2>
    <div class="add-category-container">
        <a href="agregar_categoria.php" class="add-category-link">Añadir nueva categoría</a><br><br>
    </div>
    
    <table>
        <tr>
            <th>id_categoria</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_categoria"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
        ?>
                <td>
                    <form method="get" action="modifica_categoria.php">
                        <input type='hidden' name='id_categoria' value='<?php echo $row["id_categoria"]?>'>
                        <input type='hidden' name='nombre' value='<?php echo $row["nombre"]?>'>
                        <input type='hidden' name='descripcion' value='<?php echo $row["descripcion"]?>'>
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                    </form>
                </td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="eliminarCategoria('<?php echo $row["id_categoria"]?>')"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
                </td>
        <?php
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay categorías</td></tr>";
        }
        ?>
    </table>

    <?php
    $conn->close();
    ?>
</body>
</html>
