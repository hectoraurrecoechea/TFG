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
         body {
    font-family: 'roboto', sans-serif;
    margin: 0;
    background-color: #edb45e;
}

h1 {
    font-size: 2.7em;
    text-align: center;
    background-color: #c76017;
}

h2 {
    font-size: 2em;
    color: white;
    background-color: #a07e5c;
    text-align: center;
}

h3 {
    font-size: 1.7em;
}

p {
    font-size: 1.3em;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

nav {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    padding: 0;
    margin: 0;
    background-color: rgb(225, 225, 225);
    position: sticky;
    top: 0;
    z-index: 2;
    width: 100%; /* Añadido */
}

nav li {
    margin: 0 10px;
}

nav a {
    text-decoration: none;
    padding: 5px 12px;
    font-weight: bold;
    color: black;
    margin-bottom: 10px;
}

nav a:hover {
    background-color: black;
    color: white;
    text-transform: uppercase;
}

.container {
    max-width: 1400px;
    margin: auto;
    width: 100%; /* Añadido */
    padding: 0 20px; /* Añadido */
}

header {
    width: 100%;
}

header .logo {
    margin: 0;
    padding: 15px 0; /* Ajuste del padding */
    font-weight: bold;
    color: #edb45e;
    font-size: 2.5em;
    text-align: center; /* Añadido */
    width: 100%; /* Añadido */
}

header .container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Media queries for responsiveness */

@media screen and (max-width: 768px) {
    nav {
        flex-direction: column;
        align-items: flex-start;
    }

    nav li {
        margin: 10px 0;
    }

    header .logo {
        font-size: 2em;
    }
}

@media screen and (max-width: 480px) {
    header .logo {
        font-size: 1.8em;
    }
}

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

form {
    text-align: center;
}

label, input {
    display: block;
    margin: 0 auto;
}

button {
    display: block;
    margin: 10px auto;
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
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Descripción</th><th>Precio</th></tr>";
            while ($row_producto = $result_productos->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_producto["nombre"] . "</td>";
                echo "<td>" . $row_producto["descripcion"] . "</td>";
                echo "<td>" . $row_producto["precio"] . "</td>";
                echo "<td><a href='productos.php?id_producto=" . $row_producto["id_producto"] . "'>Añadir</a></td>";
                echo "</tr>";
            }
            echo "</table>";
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
