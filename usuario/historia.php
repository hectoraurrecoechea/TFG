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
 <H1>NUESTRA HISTORIA</H1>
 <img src="IMAGENES/panaderia.jpg" width="30%" height="30%">
 <p>"Panadería Tina" es una empresa familiar. Se remonta su historia a cuarenta años atrás. Primero regentada por mi abuela Tina y quince años después por mi madre. En sus incios, solo había pan, yogures y repostería. Luego cambiaron los tiempos y aunque es una tienda de barrio, se tuvieron que incorporar muchos más productos para poder seguir en activo con el negocio, como es la fruta, drguería, embutidos... y un trato personalizado llevando la compra a casa a las personas mayores. Con todo ello, y nuestro esfuerzo familiar sigue funcionando; logicamente ahora nos adaptamos a nuevas tecnologías y ahora en breve "nuestra propia pagina web" para poder seguir dando nuestro mejor servicio a los clientes.</p>
    <br><br><h2><span class="texto-con-fondo">¿DÓNDE NOS PUEDES ENCONTRAR?</span></h2>
    <div class="mapa">
    <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2968.687521402599!2d-4.490210984557543!3d41.92107567921872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd47aeaf83ff78a1%3A0x3756de50f54fe8c7!2sPanaderia%20Tina!5e0!3m2!1ses!2ses!4v1647419873270!5m2!1ses!2ses"
    ></iframe>
</div> 

<br><br><br><br><br>
<<br><br>
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