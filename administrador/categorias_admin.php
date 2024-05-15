<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil Administrador</title>
    <link rel="stylesheet" href="estilos.css">
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
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SQL para obtener todos los usuarios
    $sql = "SELECT * FROM categorias";
    $result = $conn->query($sql);
    ?>
    <h2 class="title">Categorias en la base de datos</h2>
    <div class="add-category-container">
        <a href="agregar_categoria.php" class="add-category-link">Añadir nueva categoría</a><br><br>
    </div>
    
    <table>
        <tr>
            <th>id_categoria</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th></th>
            <th></th>
            <!-- Agrega más columnas si es necesario -->
        </tr>
        <?php
        // Iterar sobre los resultados y mostrar cada usuario en una fila de la tabla
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_categoria"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
        ?>
        <!--BOTONES ELIMINAR Y MODIFICAR -->
                <td>
                    <form method="get" action="modifica_categoria.php">
                        <input type='hidden' name='id_categoria' value='<?php echo $row["id_categoria"]?>'>
                        <input type='hidden' name='nombre' value='<?php echo $row["nombre"]?>'>
                        <input type='hidden' name='descripcion' value='<?php echo $row["descripcion"]?>'>
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="eliminar_categoria.php">
                        <input type='hidden' name='id_categoria' value='<?php echo $row["id_categoria"]?>'>
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
                    </form>
                </td>
        <?php
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay usuarios</td></tr>";
        }
        ?>
    </table>

    <?php
    // Cerrar conexión
    $conn->close();
    ?>

    

</body>
</html>
