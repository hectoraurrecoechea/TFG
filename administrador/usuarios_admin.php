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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function eliminarUsuario(dni) {
            if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                $.post("eliminarUsuarios_admin.php", { dni: dni }, function(response) {
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
    $sql = "SELECT * FROM clientes ORDER BY CASE WHEN rol = 'usuario' THEN 0 ELSE 1 END;";
    $result = $conn->query($sql);
    ?>

    <div class="table-container"> <!-- Contenedor de la tabla -->
    <h2 class="title">Usuarios en la base de datos</h2>

        <table>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido1</th>
                <th>Apellido2</th>
                <th>Teléfono</th>
                <th>Pass</th>
                <th>Correo</th>
                <th>Rol</th>
                <!-- Agrega más columnas si es necesario -->
                <th></th> <!-- Nueva columna para el enlace de Pedidos -->
            </tr>
            <?php
            // Iterar sobre los resultados y mostrar cada usuario en una fila de la tabla
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    // Botón de Pedidos
                    echo "<td><a href='pedidos_cliente.php?dni=" . $row["dni"] . "' class='btn btn-primary'><span class='glyphicon glyphicon-list-alt'></span> Pedidos</a></td>";
                    ?>
                    <!--BOTONES ELIMINAR Y MODIFICAR -->
                    <td>
                      <form method="get" action="modifica_usuario.php">
                        <input type='hidden' name='dni' value='<?php echo $row["dni"]?>'>
                        <input type='hidden' name='nombre' value='<?php echo $row["nombre"]?>'>
                        <input type='hidden' name='apellido1' value='<?php echo $row["apellido1"]?>'>
                        <input type='hidden' name='apellido2' value='<?php echo $row["apellido2"]?>'>
                        <input type='hidden' name='telefono' value='<?php echo $row["telefono"]?>'>
                        <input type='hidden' name='pass' value='<?php echo $row["pass"]?>'>
                        <input type='hidden' name='correo' value='<?php echo $row["correo"]?>'>
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                      </form>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="eliminarUsuario('<?php echo $row["dni"]?>')"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
                    </td>
                    <?php
                    echo "<td>" . $row["dni"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["apellido1"] . "</td>";
                    echo "<td>" . $row["apellido2"] . "</td>";
                    echo "<td>" . $row["telefono"] . "</td>";
                    echo "<td>" . $row["pass"] . "</td>";
                    echo "<td>" . $row["correo"] . "</td>";
                    echo "<td>" . $row["rol"] . "</td>";
                    
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
