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
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sem dui, condimentum aliquam accumsan eget, interdum non urna. Nam at enim mauris. Nunc egestas felis et ipsum ultrices, ac iaculis odio consequat. Vivamus a metus lorem. Donec tincidunt, ipsum ut efficitur tristique, dolor ex tempus dui, pulvinar malesuada dui dui vitae libero. Duis in mattis diam, ac tincidunt tellus. In hac habitasse platea dictumst. Sed libero orci, rutrum eget lacinia eget, commodo quis risus. Mauris vitae sapien aliquam, laoreet sapien ut, dignissim dolor. Vestibulum condimentum, augue id venenatis imperdiet, tellus quam cursus lorem, suscipit rhoncus diam purus quis ex. Fusce viverra, felis ac consectetur ultricies, sem libero tincidunt felis, eget efficitur diam leo at sapien. Fusce eu efficitur enim. Duis posuere mi sed suscipit cursus. Maecenas semper, ligula vel fringilla hendrerit, tortor mi sollicitudin eros, sed elementum dolor nulla at metus. Integer tincidunt dignissim diam, sed sodales mauris fringilla feugiat. <br> <br><br>

    Etiam nibh augue, sollicitudin dignissim posuere et, porttitor in tellus. Proin dapibus odio nec eleifend posuere. Suspendisse id erat venenatis, consequat purus quis, cursus massa. Cras consectetur nisi non massa congue mollis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam lorem enim, consectetur eget odio eget, facilisis facilisis purus. Maecenas sit amet ultricies lectus, nec facilisis magna. Integer aliquet rutrum risus, quis pretium eros gravida non. <br><br><br>
    
    Praesent sit amet urna justo. Maecenas nec blandit sem. Sed elementum sed arcu nec eleifend. Aliquam a ultricies ligula, sed gravida est. Donec nec interdum magna. Phasellus maximus ipsum non tellus euismod, id ornare quam porttitor. Maecenas interdum est nec vehicula rhoncus. Etiam efficitur nulla sit amet dolor feugiat rhoncus.</p>
    <br><br><h2><span class="texto-con-fondo">¿DÓNDE NOS PUEDES ENCONTRAR?</span></h2>
    <div class="mapa">
    <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2968.687521402599!2d-4.490210984557543!3d41.92107567921872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd47aeaf83ff78a1%3A0x3756de50f54fe8c7!2sPanaderia%20Tina!5e0!3m2!1ses!2ses!4v1647419873270!5m2!1ses!2ses"
    ></iframe>
</div> 

<br><br><br><br><br>
<div class="contenedor-total">
  <div class="leyenda">
    <h3>MISIÓN</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mollis eu lectus vel scelerisque. Nullam nulla eros, mattis vel mauris at, ultricies pellentesque leo. Ut ut odio at purus varius ornare. Fusce condimentum et dui vel vulputate. Aliquam ac turpis id massa auctor sollicitudin. Etiam dignissim dolor eu lorem sollicitudin interdum. In faucibus nibh at nunc convallis, in interdum sapien consequat. Mauris tempor nec ante at fringilla. Aenean nec augue ac risus dictum suscipit et at nisi. Phasellus rutrum lectus felis, tempor pharetra nunc iaculis ac. Quisque neque ex, pellentesque eget purus at, faucibus laoreet arcu.</p>
  </div>

  <div class="leyenda">
    <h3>VISIÓN</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mollis eu lectus vel scelerisque. Nullam nulla eros, mattis vel mauris at, ultricies pellentesque leo. Ut ut odio at purus varius ornare. Fusce condimentum et dui vel vulputate. Aliquam ac turpis id massa auctor sollicitudin. Etiam dignissim dolor eu lorem sollicitudin interdum. In faucibus nibh at nunc convallis, in interdum sapien consequat. Mauris tempor nec ante at fringilla. Aenean nec augue ac risus dictum suscipit et at nisi. Phasellus rutrum lectus felis, tempor pharetra nunc iaculis ac. Quisque neque ex, pellentesque eget purus at, faucibus laoreet arcu.</p>
  </div>

  <div class="leyenda">
    <h3>VALORES</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mollis eu lectus vel scelerisque. Nullam nulla eros, mattis vel mauris at, ultricies pellentesque leo. Ut ut odio at purus varius ornare. Fusce condimentum et dui vel vulputate. Aliquam ac turpis id massa auctor sollicitudin. Etiam dignissim dolor eu lorem sollicitudin interdum. In faucibus nibh at nunc convallis, in interdum sapien consequat. Mauris tempor nec ante at fringilla. Aenean nec augue ac risus dictum suscipit et at nisi. Phasellus rutrum lectus felis, tempor pharetra nunc iaculis ac. Quisque neque ex, pellentesque eget purus at, faucibus laoreet arcu.</p>
  </div>
</div><br><br>
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