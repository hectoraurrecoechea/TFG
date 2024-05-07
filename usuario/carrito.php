<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../index.php");
    exit;
}

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Verificar si ya hay productos en el carrito
    //if (!isset($_SESSION['carrito'])) {
        
        // Establecer la conexión a la base de datos (debes completar los datos de conexión)
        $conexion = new mysqli("localhost", "root", "12345", "panaderia");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Obtener el DNI del usuario
        $dni_usuario = $_SESSION['dni'];

        // Obtener productos del carrito del usuario de la base de datos
        $sql_carrito_usuario = "SELECT * FROM carrito WHERE dni = '$dni_usuario'";
        $resultado_carrito = $conexion->query($sql_carrito_usuario);
        if ($resultado_carrito->num_rows > 0) {
            // Inicializar el arreglo de carrito en la sesión
            $_SESSION['carrito'] = array();
            $_SESSION['carrito_ids'] = array(); // Nuevo arreglo para almacenar IDs de carrito

            // Recorrer los resultados y almacenarlos en la sesión
            while ($row = $resultado_carrito->fetch_assoc()) {
                $id_carrito = $row['id_carrito']; // Obtener el ID de carrito
                $id_producto = $row['id_producto'];
                $cantidad = $row['cantidad'];

                // Almacenar el ID de carrito en la sesión
                $_SESSION['carrito_ids'][] = $id_carrito; // Cambio aquí

                // Obtener información del producto desde la base de datos
                $sql_info_producto = "SELECT * FROM productos WHERE id_producto = '$id_producto'";
                $resultado_info_producto = $conexion->query($sql_info_producto);
                if ($resultado_info_producto->num_rows > 0) {
                    $info_producto = $resultado_info_producto->fetch_assoc();
                    // Almacenar información del producto en el carrito de la sesión
                    $_SESSION['carrito'][$id_producto] = array(
                        'id_producto' => $id_producto,
                        'nombre' => $info_producto['nombre'],
                        'descripcion' => $info_producto['descripcion'],
                        'precio' => $info_producto['precio'],
                        'cantidad' => $cantidad
                    );
                }
            }
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
    } else{
        
    }
//}

if ($_SESSION['rol'] == 'administrador') {
    echo "Bienvenido, Administrador!";
} else {
    //echo "Bienvenido, Usuario!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenidos!</title>
    <link rel="stylesheet" href="style_historia.css">
    <style>
       table {
           width: 80%;
           margin: 0 auto;
           border-collapse: collapse; 
       }

       th, td {
           padding: 8px;
           text-align: left;
           border-bottom: 1px solid #ddd;
       }

       th {
           background-color: #f2f2f2;
       }
    </style>
</head>
<body>

<header>
    <div class="container">
        <p class="logo">Panaderia Tina</p>
        <nav>
            <li><a href="index_usuario.php">INICIO</a></li>
            <li><a href="productos.php">PRODUCTOS</a></li>
            <li><a href="fotos.php">FOTOGRAFÍAS</a></li>
            <li><a href="historia.php">NUESTRA HISTORIA</a></li>
            <li><a href="configuracion.php"><img src="IMAGENES/configuraciones.png" alt="configuracion" width="30" height="30"></a></li>
            <li><a href="contacto.php"><img src="IMAGENES/contacto.png" alt="contacto" width="30" height="30"></a></li>
            <li><a href="buscar.php"><img src="IMAGENES/lupa.png" alt="buscar" width="30" height="30"></a></li>
            <li><a href="carrito.php"><img src="IMAGENES/carrito-de-compras.png" alt="carrito de compras" width="30" height="30"></a></li>
            <li><a href="cerrarSesion_usuario.php"><img src="IMAGENES/cerrar-sesion.png" alt="cerrarSesion" width="30" height="30"></a></li>
        </nav>
    </div>
</header>

<?php


// Función para actualizar el carrito con las nuevas cantidades
function actualizarCarrito($nuevas_cantidades) {
    foreach ($nuevas_cantidades as $id_producto => $cantidad) {
        $_SESSION['carrito'][$id_producto]['cantidad'] = $cantidad;
    }
    // Actualizar la base de datos
    actualizarBaseDeDatos();
    // Redireccionar a la página para reflejar los cambios
    header("Location: carrito.php");
    exit();
}

// Función para actualizar la base de datos con el contenido del carrito
function actualizarBaseDeDatos($borrarProducto = false, $id_producto = null) {
    $conexion = new mysqli("localhost", "root", "12345", "panaderia");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $dni_usuario = $_SESSION['dni'];
    
    // Si se va a borrar un producto específico
    if ($borrarProducto && $id_producto !== null) {
        // Eliminar el producto del carrito del usuario
        $sql_eliminar = "DELETE FROM carrito WHERE dni = '$dni_usuario' AND id_producto = '$id_producto'";
        $conexion->query($sql_eliminar);
    } else {
        // Si se va a vaciar todo el carrito del usuario
        $sql_eliminar = "DELETE FROM carrito WHERE dni = '$dni_usuario'";
        $conexion->query($sql_eliminar);
    }
    
    $conexion->close();
    header("Location: carrito.php");
    exit();
}

// Función para eliminar un elemento del carrito
function eliminarDelCarrito($id_producto) {
    //tenemos que hacer un unset para eliminar el producto de la BD
    if (isset($_SESSION['carrito'][$id_producto])) {
        unset($_SESSION['carrito'][$id_producto]);
        // Actualizar la base de datos
        $id_producto_a_eliminar = $id_producto; // Reemplaza 123 por el ID del producto que deseas eliminar
        actualizarBaseDeDatos(true, $id_producto_a_eliminar);
        // Redireccionar a la página para reflejar los cambios
        header("Location: carrito.php");
        exit();
    }
}

function vaciarCarrito($dni_usuario) {
    $conexion = new mysqli("localhost", "root", "12345", "panaderia");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $dni_usuario = $_SESSION['dni'];
    // Eliminar todos los productos del carrito del usuario
    $sql_eliminar = "DELETE FROM carrito WHERE dni = '$dni_usuario'";
    $conexion->query($sql_eliminar);
    $conexion->close();
    unset($_SESSION['carrito']);
    header("Location: carrito.php");
    exit();
}



function finalizarPedido($dni_usuario){
    if (!isset($_SESSION['carrito_ids'])) {
        $_SESSION['carrito_ids'] = array();
    }
    
    $conexion = new mysqli("localhost", "root", "12345", "panaderia");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    foreach ($_SESSION['carrito_ids'] as $id_carrito) {
        $sql_finalizar = "INSERT INTO pedidos (id_pedido, estado_pedido, fecha_pedido, id_carrito) SELECT NULL, 'pendiente', NOW(), id_carrito FROM carrito 
        WHERE id_carrito = '$id_carrito'";
        $conexion->query($sql_finalizar);
    }
    // Eliminar los productos del carrito del usuario
    $sql_eliminar_carrito = "DELETE FROM carrito WHERE dni = '$dni_usuario'";
    $conexion->query($sql_eliminar_carrito);
    $conexion->close();
    header("Location: carrito.php");
    exit();
}
?>

<?php
// Verificar si hay productos en el carrito
if (!empty($_SESSION['carrito'])) {
    echo "<h2>Carrito de Compras</h2>";
    echo "<form method='post'>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Descripción</th><th>Precio Unitario</th><th>Cantidad</th><th>Modificar</th><th>Total</th><th>Acción</th></tr>";

    $total_suma = 0;

    foreach ($_SESSION['carrito'] as $id_producto => $producto) {
        // Si la cantidad no está definida, establecerla como 1 por defecto
        $cantidad = isset($producto['cantidad']) ? $producto['cantidad'] : 1;

        // Calcular el precio total
        $precio_total = $producto['precio'] * $cantidad;

        // Sumar al total
        $total_suma += $precio_total;

        echo "<tr>";
        echo "<td>" . $producto['nombre'] . "</td>";
        echo "<td>" . $producto['descripcion'] . "</td>";
        echo "<td>" . $producto['precio'] . " €</td>";
        //echo "<td><input type='number' name='cantidad[$id_producto]' min='1' max='10' value='" . $producto['cantidad'] . "'></td>";
        echo "<td><label>".$producto['cantidad']."</label></td>";
        echo "<td>
        <button>+</button>
        <button>-</button>
        </td>";
        echo "<td>$precio_total €</td>";
        echo "<td>
                <form method='post'>
                    <input type='hidden' name='id_producto' value='" . $id_producto . "'>
                    <button type='submit' name='eliminar'>Borrar</button>  
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";

    // Mostrar la suma total
    echo "<p>Total: $total_suma €</p>";
    // Botón para vaciar el carrito con las nuevas cantidades
    echo "<button type='submit' name='vaciarCarrito'>Vaciar Carrito</button>";

    // Botón para finalizar el pedido
    echo "<input type='hidden' name='dni_usuario' value='".$_SESSION['dni']."'>";
    echo "<button type='submit' name='finalizarPedido'>Finalizar pedido</button>";

    echo "</form>";

    // Procesar la actualización del carrito si se envió el formulario
    if(isset($_POST['vaciarCarrito'])) {
        if(isset($_POST['dni_usuario'])) {
            vaciarCarrito($_POST['dni_usuario']);
        }
    }

    // Procesar la eliminación de un producto del carrito si se hizo clic en el botón "Eliminar"
    if(isset($_POST['eliminar']) && isset($_POST['id_producto'])) {
        eliminarDelCarrito($_POST['id_producto']);
    }

    // Procesar el pedido finalizado si se hizo clic en el botón "Finalizar pedido"
    if(isset($_POST['finalizarPedido']) && isset($_POST['dni_usuario'])) {
        finalizarPedido($_POST['dni_usuario']);
    }
    

} else {
    echo "<p>No hay productos en el carrito.</p>";
}
?>
</body>
</html>
