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
    <link rel="stylesheet" href="style_productos.css">
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
            <li><a href="configuracion.php">CONFIGURACION</a></li>
            <li><a href="contacto.php">CONTACTO</a></li>
            <li><a href="buscar.php">BUSCAR PRODUCTO</a></li>
            <li><a href="carrito.php">CARRITO</a></li>
            <li><a href="cerrarSesion_usuario.php">Cerrar sesion</a></li>
         </nav>
     </div>
 </header>
 <?php

// Función para eliminar un elemento del carrito
function eliminarDelCarrito($id_producto) {
    if (isset($_SESSION['carrito'][$id_producto])) {
        unset($_SESSION['carrito'][$id_producto]);
        // Redireccionar a la página para reflejar los cambios
        header("Location: carrito.php");
        exit();
    }
}

// Función para actualizar el carrito con las nuevas cantidades
function actualizarCarrito($nuevas_cantidades) {
    foreach ($nuevas_cantidades as $id_producto => $cantidad) {
        $_SESSION['carrito'][$id_producto]['cantidad'] = $cantidad;
    }
    // Redireccionar a la página para reflejar los cambios
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
    echo "<tr><th>Nombre</th><th>Descripción</th><th>Precio Unitario</th><th>Cantidad</th><th>Total</th><th>Acción</th></tr>";

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
        echo "<td><input type='number' name='cantidad[$id_producto]' min='1' max='10' value='$cantidad'></td>";
        echo "<td>$precio_total €</td>";
        echo "<td>
                <form method='post'>
                    <input type='hidden' name='id_producto' value='$id_producto'>
                    <button type='submit' name='eliminar'>Eliminar</button>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";

    // Mostrar la suma total
    echo "<p>Total: $total_suma €</p>";
    // Botón para actualizar el carrito con las nuevas cantidades
    echo "<button type='submit' name='actualizar_carrito'>Actualizar Carrito</button>";
    echo "</form>";

    // Procesar la actualización del carrito si se envió el formulario
    if(isset($_POST['actualizar_carrito'])) {
        if(isset($_POST['cantidad'])) {
            actualizarCarrito($_POST['cantidad']);
        }
    }

    // Procesar la eliminación de un producto dels carrito si se hizo clic en el botón "Eliminar"
    if(isset($_POST['eliminar']) && isset($_POST['id_producto'])) {
        eliminarDelCarrito($_POST['id_producto']);
    }

} else {
    echo "<p>No hay productos en el carrito.</p>";
}
?>




