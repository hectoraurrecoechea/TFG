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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenidos!</title>
    <link rel="stylesheet" href="estilos_index.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Indie+Flower&display=swap" rel="stylesheet">

    <style>
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

<div class="welcome-section">
    <h1 id="welcome-title" class="hidden">Bienvenidos a Panaderia Tina</h1>
    <p id="welcome-subtitle" class="hidden">Tu tienda de ultramarinos de confianza</p>
</div>

<div class="offers-section">
    <h2>Nuestros productos en oferta</h2>
    <div class="carousel">
        <div class="carousel-arrow carousel-arrow-left" id="carousel-arrow-left">&#9664;</div>
        <div class="carousel-container">
            <div class="carousel-item"><img src="fotosTienda/FRUTAS/futas1.jpeg" alt="Oferta 1"></div>
            <div class="carousel-item"><img src="fotosTienda/FRUTAS/futas2.jpeg" alt="Oferta 2"></div>
            <div class="carousel-item"><img src="fotosTienda/FRUTAS/futas3.jpeg" alt="Oferta 3"></div>
            <div class="carousel-item"><img src="fotosTienda/FRUTAS/futas4.jpeg" alt="Oferta 4"></div>
            <div class="carousel-item"><img src="fotosTienda/FRUTAS/futas5.jpeg" alt="Oferta 5"></div>
        </div>
        <div class="carousel-arrow carousel-arrow-right" id="carousel-arrow-right">&#9654;</div>
    </div>
</div>

<div class="order-section">
    <h2>¿Ya sabes qué pedir?</h2>
    <button onclick="window.location.href='productos.php'">¡Realiza tu pedido!</button>
</div>

<div class="map-section">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2968.687521402599!2d-4.490210984557543!3d41.92107567921872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd47aeaf83ff78a1%3A0x3756de50f54fe8c7!2sPanaderia%20Tina!5e0!3m2!1ses!2ses!4v1647419873270!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>

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

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const h1 = document.getElementById('welcome-title');
        const p = document.getElementById('welcome-subtitle');
        
        setTimeout(() => {
            h1.classList.add('visible');
        }, 1000);

        setTimeout(() => {
            p.classList.add('visible');
        }, 2000);
    });
</script>
<script src="carrusel.js"></script>
</body>
</html>
