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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .gallery-section {
            margin: 20px;
        }
        .gallery-title {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
        }
        .gallery-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .gallery-row img {
            width: calc(20% - 8px); /* Ajuste para que las imágenes quepan en una fila con margen */
            margin: 4px;
            border-radius: 10px;
        }
        @media (max-width: 800px) {
            .gallery-row img {
                width: calc(33.33% - 8px); /* Ajuste para pantallas medianas */
            }
        }
        @media (max-width: 500px) {
            .gallery-row img {
                width: calc(50% - 8px); /* Ajuste para pantallas pequeñas */
            }
        }
    </style>
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
 <body>
    <!-- Sección de Frutas -->
    <div class="gallery-section">
        <div class="gallery-title">Frutas</div>
        <div class="gallery-row">
            <img src="fotosTienda/FRUTAS/futas1.jpeg" alt="Fruta 1" >
            <img src="fotosTienda/FRUTAS/futas2.jpeg" alt="Fruta 2" >
            <img src="fotosTienda/FRUTAS/futas3.jpeg" alt="Fruta 3" >
            <img src="fotosTienda/FRUTAS/futas4.jpeg" alt="Fruta 4" >
            <img src="fotosTienda/FRUTAS/futas5.jpeg" alt="Fruta 5" >
        </div>
        <div class="gallery-row">
            <img src="fotosTienda/FRUTAS/futas6.jpeg" alt="Fruta 6" >
            <img src="fotosTienda/FRUTAS/futas7.jpeg" alt="Fruta 7" >
            <img src="fotosTienda/FRUTAS/futas8.jpeg" alt="Fruta 8" >
            <img src="fotosTienda/FRUTAS/futas9.jpeg" alt="Fruta 9" >
            <img src="fotosTienda/FRUTAS/futas10.jpeg" alt="Fruta 10" >
        </div>
        <div class="gallery-row">
            <img src="fotosTienda/FRUTAS/futas11.jpeg" alt="Fruta 11" >
            <img src="fotosTienda/FRUTAS/futas12.jpeg" alt="Fruta 12" >
            <img src="fotosTienda/FRUTAS/futas13.jpeg" alt="Fruta 13" >
            <img src="fotosTienda/FRUTAS/futas14.jpeg" alt="Fruta 14" >
            <img src="fotosTienda/FRUTAS/futas15.jpeg" alt="Fruta 15" >
        </div>
        <div class="gallery-row">
            <img src="fotosTienda/FRUTAS/futas16.jpeg" alt="Fruta 16" >
            <img src="fotosTienda/FRUTAS/futas17.jpeg" alt="Fruta 17" >
            <img src="fotosTienda/FRUTAS/futas18.jpeg" alt="Fruta 18" >
        </div>
    </div>

    <!-- Sección de Verduras -->
    <div class="gallery-section">
        <div class="gallery-title">Verduras</div>
        <div class="gallery-row">
            <img src="fotosTienda/VERDURAS/verduras1.jpeg" alt="Verdura 1" >
            <img src="fotosTienda/VERDURAS/verduras2.jpeg" alt="Verdura 2" >
            <img src="fotosTienda/VERDURAS/verduras3.jpeg" alt="Verdura 3" >
            <img src="fotosTienda/VERDURAS/verduras4.jpeg" alt="Verdura 4" >
            <img src="fotosTienda/VERDURAS/verduras5.jpeg" alt="Verdura 5" >
        </div>
        <div class="gallery-row">
            <img src="fotosTienda/VERDURAS/verduras6.jpeg" alt="Verdura 6" >
            <img src="fotosTienda/VERDURAS/verduras7.jpeg" alt="Verdura 7" >
            <img src="fotosTienda/VERDURAS/verduras8.jpeg" alt="Verdura 8" >
            <img src="fotosTienda/VERDURAS/verduras9.jpeg" alt="Verdura 9" >
            <img src="fotosTienda/VERDURAS/verduras10.jpeg" alt="Verdura 10" >
        </div><div class="gallery-row">
            <img src="fotosTienda/VERDURAS/verduras11.jpeg" alt="Verdura 11" >
            <img src="fotosTienda/VERDURAS/verduras12.jpeg" alt="Verdura 12" >
            <img src="fotosTienda/VERDURAS/verduras13.jpeg" alt="Verdura 13" >
            <img src="fotosTienda/VERDURAS/verduras14.jpeg" alt="Verdura 14" >
            <img src="fotosTienda/VERDURAS/verduras15.jpeg" alt="Verdura 15" >
        </div>
        <div class="gallery-row">
            <img src="fotosTienda/VERDURAS/verduras16.jpeg" alt="Verdura 16" >
            <img src="fotosTienda/VERDURAS/verduras17.jpeg" alt="Verdura 17" >
            <img src="fotosTienda/VERDURAS/verduras18.jpeg" alt="Verdura 18" >
            <img src="fotosTienda/VERDURAS/verduras19.jpeg" alt="Verdura 19" >
            <img src="fotosTienda/VERDURAS/verduras20.jpeg" alt="Verdura 20" >
        </div>
        <div class="gallery-row">
            <img src="fotosTienda/VERDURAS/verduras22.jpeg" alt="Verdura 22" >
            <img src="fotosTienda/VERDURAS/verduras21.jpeg" alt="Verdura 21" >
        </div>
    </div>
    <!-- Sección de legumbres -->
    <div class="gallery-section">
        <div class="gallery-title">Legumbres</div>
        <div class="gallery-row">
            <img src="fotosTienda/LEGUMBRES/alubias1.jpeg" alt="Legumbres 1" >
            <img src="fotosTienda/LEGUMBRES/alubias2.jpeg" alt="Legumbres 2" >
            <img src="fotosTienda/LEGUMBRES/alubias3.jpeg" alt="Legumbres 3" >
            <img src="fotosTienda/LEGUMBRES/garbanzos.jpeg" alt="Legumbres 4" >
            <img src="fotosTienda/LEGUMBRES/lentejas.jpeg" alt="Legumbres 5" >
        </div>
    </div>
    <!-- Sección de huevos -->
    <div class="gallery-section">
        <div class="gallery-title">Huevos</div>
        <div class="gallery-row">
            <img src="fotosTienda/HUEVOS/huevos1.jpeg" alt="Huevos 1" >
            <img src="fotosTienda/HUEVOS/huevos2.jpeg" alt="Huevos 2" >
            <img src="fotosTienda/HUEVOS/huevos3.jpeg" alt="Huevos 3" >
        </div>
    </div>
    <!-- Sección de embutidos -->
    <div class="gallery-section">
        <div class="gallery-title">Embutidos</div>
        <div class="gallery-row">
            <img src="fotosTienda/EMBUTIDOS/chorizo1.jpeg" alt="Embutidos 1" >
            <img src="fotosTienda/EMBUTIDOS/chorizo2.jpeg" alt="Embutidos 2" >
            <img src="fotosTienda/EMBUTIDOS/chorizo3.jpeg" alt="Embutidos 3" >
            <img src="fotosTienda/EMBUTIDOS/fuet.jpeg" alt="Embutidos  4" >
            <img src="fotosTienda/EMBUTIDOS/morcilla.jpeg" alt="Embutidos 5" >
        </div>
    </div>
    <!-- Sección de dulces -->
    <div class="gallery-section">
        <div class="gallery-title">Dulces</div>
        <div class="gallery-row">
            <img src="fotosTienda/DULCES/bolloCrema.jpeg" alt="Dulces 1" >
            <img src="fotosTienda/DULCES/donuts1.jpeg" alt="Dulces 2" >
            <img src="fotosTienda/DULCES/donuts2.jpeg" alt="Dulces 3" >
            <img src="fotosTienda/DULCES/magdalenas1.jpeg" alt="Dulces 4">
            <img src="fotosTienda/DULCES/magdalenas2.jpeg" alt="Dulces 5" >
        </div>
    </div>
    <div class="gallery-section">
        <div class="gallery-row">
            <img src="fotosTienda/DULCES/setas1.jpeg" alt="Dulces 5" >
            <img src="fotosTienda/DULCES/setas2.jpeg" alt="Dulces 6" >
            <img src="fotosTienda/DULCES/sobaos.jpeg" alt="Dulces 7" >
            <img src="fotosTienda/DULCES/sobaos2.jpeg" alt="Dulces 8">
        </div>
    </div>
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