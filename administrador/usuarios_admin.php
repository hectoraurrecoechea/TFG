<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil Administrador</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            overflow-x: hidden; /* Evita el scroll horizontal */
        }
        .table-container {
            overflow-x: auto; /* Permite el scroll horizontal si es necesario */
            width: 100%; /* Ocupa el 100% del ancho de su contenedor */
            margin-bottom: 20px; /* Espacio entre la tabla y el borde inferior */
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
    $sql = "SELECT * FROM clientes";
    $result = $conn->query($sql);
    ?>

    <div class="table-container"> <!-- Contenedor de la tabla -->
    <h2 class="title">Usuarios en la base de datos</h2>

        <table>
            <tr>
                <th>DNI</th>
                <th>Pass</th>
                <th>Correo</th>
                <th>Nombre</th>
                <th>Apellido1</th>
                <th>Apellido2</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th></th>
                <th></th>
                <!-- Agrega más columnas si es necesario -->
            </tr>
            <?php
            // Iterar sobre los resultados y mostrar cada usuario en una fila de la tabla
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["dni"] . "</td>";
                    echo "<td>" . $row["pass"] . "</td>";
                    echo "<td>" . $row["correo"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["apellido1"] . "</td>";
                    echo "<td>" . $row["apellido2"] . "</td>";
                    echo "<td>" . $row["telefono"] . "</td>";
                    echo "<td>" . $row["rol"] . "</td>";
                    ?>
                    <!--BOTONES ELIMINAR Y MODIFICAR -->
                    <td>
                      <form method="get" action="modifica_usuario.php">
                        <input type='hidden' name='dni' value='<?php echo $row["dni"]?>'>
                        <input type='hidden' name='pass' value='<?php echo $row["pass"]?>'>
                        <input type='hidden' name='correo' value='<?php echo $row["correo"]?>'>
                        <input type='hidden' name='nombre' value='<?php echo $row["nombre"]?>'>
                        <input type='hidden' name='apellido1' value='<?php echo $row["apellido1"]?>'>
                        <input type='hidden' name='apellido2' value='<?php echo $row["apellido2"]?>'>
                        <input type='hidden' name='telefono' value='<?php echo $row["telefono"]?>'>
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                      </form>
                    </td>
                    <td>
                      <form method="post" action="eliminarUsuarios_admin.php">
                        <input type='hidden' name='dni' value='<?php echo $row["dni"]?>'>
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
    </div> <!-- Fin del contenedor de la tabla -->

    <?php
    // Cerrar conexión
    $conn->close();
    ?>

</body>
</html>
