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
 <h2>Buscar Producto</h2>
    <form action="buscar.php" method="GET">
        <label for="keyword">¿Qué estás buscando?</label>
        <input type="text" id="keyword" name="keyword">
        
        <button type="submit">Buscar</button>
    </form><br><br>
    <?php
// Establecer la conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "12345";
$database = "panaderia";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

// Verificar si se ha enviado una palabra clave para buscar
if(isset($_GET['keyword'])) {
    // Obtener la palabra clave a buscar
    $keyword = $_GET['keyword'];

    // Consulta SQL para buscar productos por palabra clave
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%$keyword%'";

    $result = $conn->query($sql);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Mostrar los datos de los productos encontrados en una tabla
        echo "<table border='1'>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nombre"]. "</td>";
            echo "<td>" . $row["descripcion"]. "</td>";
            echo "<td>$" . $row["precio"]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron productos con esa palabra clave.";
    }
} else {
    echo "No se ha proporcionado una palabra clave para buscar.";
}

// Cerrar la conexión
$conn->close();
?>




 </html>