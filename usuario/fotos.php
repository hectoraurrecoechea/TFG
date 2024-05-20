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
    <link rel="stylesheet" href="estilos_historia.css">
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