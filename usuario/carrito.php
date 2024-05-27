<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../index.php");
    exit;
}

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Establecer la conexión a la base de datos
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
            $_SESSION['carrito_ids'][] = $id_carrito;

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
}

if ($_SESSION['rol'] == 'administrador') {
    echo "Bienvenido, Administrador!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenidos!</title>
    <link rel="stylesheet" href="estilos_carrito.css">
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
// Procesar la actualización del carrito si se envió el formulario
if(isset($_POST['actualizarCantidad'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    // Limitar la cantidad a un mínimo de 1 y un máximo de 10
    if($cantidad < 1) {
        $cantidad = 1;
    } elseif($cantidad > 10) {
        $cantidad = 10;
    }
    actualizarCantidadProducto($id_producto, $cantidad);
}

// Función para actualizar la cantidad de un producto en el carrito
function actualizarCantidadProducto($id_producto, $cantidad) {
    $_SESSION['carrito'][$id_producto]['cantidad'] = $cantidad;

    // Actualizar la base de datos
    actualizarBaseDeDatos($id_producto, $cantidad);
}

// Función para actualizar la base de datos con la nueva cantidad del producto
function actualizarBaseDeDatos($id_producto, $cantidad) {
    $conexion = new mysqli("localhost", "root", "12345", "panaderia");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $dni_usuario = $_SESSION['dni'];
    
    // Actualizar la cantidad del producto en la base de datos
    $sql_actualizar = "UPDATE carrito SET cantidad = '$cantidad' WHERE dni = '$dni_usuario' AND id_producto = '$id_producto'";
    $conexion->query($sql_actualizar);
    
    $conexion->close();
}

// Función para eliminar un elemento del carrito y de la base de datos
function eliminarDelCarrito($id_producto) {
    // Verificar si el producto está en el carrito
    if (isset($_SESSION['carrito'][$id_producto])) {
        // Eliminar el producto del carrito
        unset($_SESSION['carrito'][$id_producto]);
        // Actualizar la base de datos para eliminar el producto
        eliminarDeBaseDeDatos($id_producto);
        // Redireccionar a la página para reflejar los cambios
        header("Location: carrito.php");
        exit();
    }
}

// Función para eliminar un producto de la base de datos
function eliminarDeBaseDeDatos($id_producto) {
    $conexion = new mysqli("localhost", "root", "12345", "panaderia");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $dni_usuario = $_SESSION['dni'];
    
    // Eliminar el producto de la base de datos
    $sql_eliminar = "DELETE FROM carrito WHERE dni = '$dni_usuario' AND id_producto = '$id_producto'";
    $conexion->query($sql_eliminar);
    
    $conexion->close();
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
    
    $conexion = new mysqli("localhost", "root", "12345", "panaderia");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
    $fecha_pedido = date("Y-m-d H:i:s");
    $sql_finalizar = "INSERT INTO `pedidos` (`id_pedido`, `estado_pedido`, `dni`, `fecha_pedido`) VALUES (NULL, '0', '$dni_usuario', '$fecha_pedido');";
    $conexion->query($sql_finalizar);

    $sql_consulta = "SELECT id_pedido FROM pedidos WHERE dni = '$dni_usuario' AND fecha_pedido = '$fecha_pedido'";
    $result_consulta = $conexion->query($sql_consulta);
    
    $row = $result_consulta->fetch_assoc();
    $id_pedido = $row['id_pedido'];
    
    foreach ($_SESSION['carrito'] as $id_producto => $producto) {
        $sql_insertar = "INSERT INTO `pedidos_productos`(`id_pedido`, `id_producto`, `cantidad`) VALUES ('$id_pedido',".$producto['id_producto'].",".$producto['cantidad'].")";
        $conexion->query($sql_insertar);
    }
    header("Location: confirmacion.php");

    // Eliminar los productos del carrito del usuario
    $sql_eliminar = "DELETE FROM carrito WHERE dni = '$dni_usuario'";
    $conexion->query($sql_eliminar);
    $conexion->close();
    unset($_SESSION['carrito']);
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
    echo "<td>" . number_format($producto['precio'], 2) . " €</td>";
    echo "<td><label>".$producto['cantidad']."</label></td>";
    echo "<td>
            <form method='post'>
                <input type='hidden' name='id_producto' value='" . $id_producto . "'>
                <input type='hidden' name='cantidad' value='" . ($cantidad + 0.1) . "'>
                <button type='submit' name='actualizarCantidad' class='botonSuma'>+</button>  
            </form>
            <form method='post'>
                <input type='hidden' name='id_producto' value='" . $id_producto . "'>
                <input type='hidden' name='cantidad' value='" . ($cantidad - 0.1) . "'>
                <button type='submit' name='actualizarCantidad' class='botonSuma'>-</button>  
            </form>
          </td>";
    echo "<td>" . number_format($precio_total, 2) . " €</td>";
    echo "<td>
    <form method='post'>
        <input type='hidden' name='id_producto' value='" . $id_producto . "'>
        <button type='submit' name='eliminar' class='boton2'>Borrar</button>  
    </form>
  </td>";
    echo "</tr>";
}
echo "</table>";
echo "<div class='container-central'>";
// Mostrar la suma total
echo "<p class='total'>Total: " . number_format($total_suma, 2) . " €</p>";

    // Botón para vaciar el carrito con las nuevas cantidades
    echo "<button type='submit' name='vaciarCarrito' class='boton'>Vaciar Carrito</button>";
    echo "<br><br>";

    // Botón para finalizar el pedido
    echo "<input type='hidden' name='dni_usuario' value='".$_SESSION['dni']."'>";
    echo "<button type='submit' name='finalizarPedido' class='boton'>Finalizar pedido</button>";
    echo "</div>";
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
    echo "<p class='noProductos'>No hay productos en el carrito.</p>";
}
?>
</body>
<footer>
    <div class="contact-info">
        <h3>Contacto</h3>
        <p>Teléfono: 607 92 28 80</p>
        <p>Dirección: Ctra. Baños, 13, 34200 Venta de Baños, Palencia</p>
        <p>Correo: pantina@gmail.com</p>
        <p>Facebook: <a href="https://m.facebook.com/Panader%C3%ADa-Tina-118683468689693/">PANADERIA TINA</a></p>
    </div>
    <div class="logo">
        <img src="IMAGENES/logo.jpg" alt="Logo" style="width: 200px; height: auto;">
    </div>
    <div class="follow-us">
        <h3>Síguenos</h3>
        <div class="social-icons">
            <a href="https://m.facebook.com/Panader%C3%ADa-Tina-118683468689693/" target="_blank"><img src="IMAGENES/facebook.png" alt="Facebook"></a>
            <a href="https://www.twitter.com/ejemplo" target="_blank"><img src="IMAGENES/twiter.png" alt="Twitter"></a>
            <a href="https://www.instagram.com/ejemplo" target="_blank"><img src="IMAGENES/instagram.png" alt="Instagram"></a>
        </div>
    </div>
</footer>
</html>
