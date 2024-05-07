<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../index.php");
    exit;
}

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


// Verificar si se ha pasado un id de producto por GET
if(isset($_GET['id_producto'])){
    $id_producto = $_GET['id_producto'];

    // Conectarse a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $database = "panaderia";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para obtener la información del producto
    $sql_producto = "SELECT id_producto, nombre, descripcion, precio FROM productos WHERE id_producto = $id_producto";
    $result_producto = $conn->query($sql_producto);

    if ($result_producto->num_rows > 0) {
        $row_producto = $result_producto->fetch_assoc();

        // Guardar la información del producto en una sesión asociada al usuario
        $producto = array(
            'id_producto' => $row_producto["id_producto"], // Se incluye la clave 'id_producto'
            'nombre' => $row_producto["nombre"],
            'descripcion' => $row_producto["descripcion"],
            'precio' => $row_producto["precio"]
        );

        // Almacenar el carrito en la sesión del usuario
        if(!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }
        $_SESSION['carrito'][$id_producto] = $producto;

        // Redireccionar a la página de productos
        header("Location: productos.php");
        exit();
    } else {
        echo "No se encontró el producto.";
    }

    $conn->close();
}
?>
<!-- Tu código HTML para mostrar productos y categorías aquí -->

 <?php
// Conexión a la base de datos (asegúrate de cambiar estos valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "12345";
$database = "panaderia";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener todas las categorías
$sql_categorias = "SELECT id_categoria, nombre, descripcion FROM categorias";
$result_categorias = $conn->query($sql_categorias);

// Definir la función con un parámetro
function miFuncion($parametro) {
    // Código de la función aquí que puede utilizar $parametro
    $conexion = new mysqli("localhost", "root", "12345","panaderia");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
    $dni_usuario = $_SESSION['dni'];
    
    // Obtener el ID del carrito
    $sql_idCarrito = "SELECT id_carrito FROM `carrito` WHERE dni='$dni_usuario'";
    $result_idCarrito = $conexion->query($sql_idCarrito);
    
    if ($result_idCarrito->num_rows > 0) {
        echo "estoy aqui";
        // Extraer el resultado de la consulta
        $row = $result_idCarrito->fetch_assoc();
        $id_carrito = $row['id_carrito'];
        //HACEMOS COUNT ---------------------------
        $sql_count = "SELECT COUNT(*) FROM `carrito` WHERE dni='$dni_usuario' AND id_producto='$parametro'";
        $result_count = $conexion->query($sql_count);
        // Verificar si la consulta fue exitosa
        if ($result_count) {
            // Obtener el resultado del conteo de filas
            $row_count = $result_count->fetch_row();
            $count = $row_count[0];

    
            if ($count > 0) {
                // Insertar el producto en el carrito
                $sql_insertar = "UPDATE `carrito` SET `cantidad`=cantidad+1 WHERE dni='$dni_usuario' AND id_producto='$parametro'";
                if ($conexion->query($sql_insertar) === TRUE) {
                    echo "Producto actualizado correctamente.";
                } else {
                    echo "Error al actualizar el producto: " . $conexion->error;
                }
            } else {
                // Insertar el producto en el carrito
                $sql_insertar = "INSERT INTO carrito (id_carrito,dni, id_producto, cantidad) VALUES ('$id_carrito','$dni_usuario', '$parametro', 1)";
                if ($conexion->query($sql_insertar) === TRUE) {
                    echo "Producto insertado correctamente.";
                } else {
                    echo "Error al insertar el producto: " . $conexion->error;
                }
            }
        } else {
            echo "Error en la consulta: " . $conexion->error;
        }
    }
    
    else {
        $cantidad = 1;
     // Insertar el producto en el carrito
     $sql_insertar = "INSERT INTO carrito ( dni, id_producto,cantidad) VALUES ( '$dni_usuario', '$parametro','$cantidad')";
     //$sql_insertar = "INSERT INTO `carrito`(`id_carrito`, `dni`) VALUES ('$id_carrito','$dni_usuario')";
     if ($conexion->query($sql_insertar) === TRUE) {
         echo "Producto insertado correctamente.";
     } else {
         echo "Error al insertar el producto: " . $conexion->error;
     }   
    }
    
    $conexion->close();
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["boton"])) {
    // Llamar a la función y pasar un parámetro
    $id_producto = $_POST["boton"];
    miFuncion($id_producto);
}

// Verificar si se encontraron categorías
if ($result_categorias->num_rows > 0) {
    // Iterar sobre cada categoría
    while ($row_categoria = $result_categorias->fetch_assoc()) {
        echo "<h2 style='text-align: center;'>Categoría: " . $row_categoria["nombre"] . "</h2>";
        echo "<p style='text-align: center;'>" . $row_categoria["descripcion"] . "</p>";

        // Consulta SQL para obtener todos los productos de la categoría actual
        $categoria_id = $row_categoria["id_categoria"];
        $sql_productos = "SELECT id_producto,nombre, descripcion, precio FROM productos WHERE id_categoria = $categoria_id";
        $result_productos = $conn->query($sql_productos);

        
        // Verificar si se encontraron productos
        if ($result_productos->num_rows > 0) {
            // Mostrar los productos en una tabla
            echo '<div style="text-align: center;">'; // Contenedor para centrar la tabla
            echo '<table style="border-collapse: collapse; margin: 0 auto;">'; // Estilos para centrar la tabla y colapsar los bordes
            echo '<tr style="background-color: white; color: black;">'; // Fila para el encabezado
            echo '<th style="width: 100px; border: 1px solid black;">Nombre</th>'; // Estilos para la columna Nombre
            echo '<th style="width: 500px; border: 1px solid black;">Descripción</th>'; // Estilos para la columna Descripción
            echo '<th style="width: 40px; border: 1px solid black;">Precio</th>'; // Estilos para la columna Precio
            echo '<th style="border: 1px solid black;">&nbsp;</th>'; // Estilos para la columna "Añadir al carrito"
            echo '</tr>'; // Cerrar fila de encabezado

            while ($row_producto = $result_productos->fetch_assoc()) {
            echo '<tr>';
                echo '<td style="border: 1px solid black; width: 200px;">' . $row_producto['nombre'] . '</td>'; // Estilos para la columna Nombre
                echo '<td style="border: 1px solid black; width: 1000px;">' . $row_producto['descripcion'] . '</td>'; // Estilos para la columna Descripción
                echo '<td style="border: 1px solid black; width: 100px;">' . $row_producto['precio'] . '€</td>'; // Estilos para la columna Precio
                echo '<td style="border: 1px solid black;">';
                echo '<form method="post">';
                echo '<button type="submit" name="boton" value="' . $row_producto['id_producto'] . '">añadir carrito</button>'; // Estilos para el botón "Añadir al carrito"
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }

echo '</table>'; // Cerrar tabla
echo '</div>'; // Cerrar contenedor


        } else {
            echo "<p style='text-align: center; color:white; background-color:red'>No se encontraron productos para esta categoría.</p>";
        }
        echo "<br>";
    }
} else {
    echo "<p style='text-align: center;'>No se encontraron categorías.</p>";
}

$conn->close();
?>

 </html>
