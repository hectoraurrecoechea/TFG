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
    <link rel="stylesheet" href="estilos_contacto.css">
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
 <div class="container2">
    <div class="contact-info">
        <ul>
            <li><img src="imagenes/movil.png" width="30px" height="20px"> TELÉFONO: 607922880</li>
            <li><img src="imagenes/instagram.png" width="30px" height="20px">INSTAGRAM: PanaderiaTina VentaDeBaños</li>
            <li><img src="imagenes/gmail.png" width="30px" height="20px"> CORREO: tupanaderiadeconfianza@hotmail.com</li>
            <li><img src="imagenes/twiter.png" width="30px" height="20px"> TWITER: PanaderiaTina2010</li>
            <li><img src="imagenes/facebook.png" width="30px" height="20px">FACEBOOK:<a href="https://m.facebook.com/Panader%C3%ADa-Tina-118683468689693/">  PanaderiaTina2010</a></li>
        </ul>
    </div>

    <div class="schedule-table">
        <table class="default">
            <tr>
                <th></th>
                <th><h1>HORARIO</h1></th>
                <th></th>
            </tr>
            <tr>
                <th>DÍA</th>
                <th>MAÑANA</th>
                <th>TARDE</th>
            </tr>
            <tr>
                <td>LUNES</td>
                <td>8:15-14:15</td>
                <td>18:00-21:00</td>
            </tr>
            <tr>
                <td>MARTES</td>
                <td>8:15-14:15</td>
                <td>18:00-21:00</td>
            </tr>
            <tr>
                <td>MIÉRCOLES</td>
                <td>8:15-14:15</td>
                <td>18:00-21:00</td>
            </tr>
            <tr>
                <td>JUEVES</td>
                <td>8:15-14:15</td>
                <td>18:00-21:00</td>
            </tr>
            <tr>
                <td>VIERNES</td>
                <td>8:15-14:15</td>
                <td>18:00-21:00</td>
            </tr>
            <tr>
                <td>SÁBADO</td>
                <td>8:15-14:15</td>
                <td>18:00-21:00</td>
            </tr>
            <tr>
                <td>DOMINGO</td>
                <td>Cerrado</td>
                <td>Cerrado</td>
            </tr>
        </table>
</div>
</div>

</body>
<footer>
    <div class="contact-info2">
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