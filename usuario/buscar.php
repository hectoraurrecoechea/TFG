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
    <link rel="stylesheet" href="estilo_productos.css">
    
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
 <div class="formulario">
    <form action="buscar.php" method="GET">
        <label for="keyword">¿Qué estás buscando?</label>
        <input type="text" id="keyword" name="keyword">
        
        <button type="submit" class="boton">Buscar</button>
    </form><br><br>
</div>
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
        echo "<table>
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
    //echo "No se ha proporcionado una palabra clave para buscar.";
}

// Cerrar la conexión
$conn->close();
?>




 </html>