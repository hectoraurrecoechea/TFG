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
    <link rel="stylesheet" href="style_historia.css">
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
 <H1>NUESTRA HISTORIA</H1>
 <img src="https://scontent-mad2-1.xx.fbcdn.net/v/t39.30808-6/299716935_525305212725457_6338718836353774532_n.jpg?stp=dst-jpg_s960x960&_nc_cat=108&ccb=1-7&_nc_sid=5f2048&_nc_ohc=qOC8nUfLs68Ab5-HzFd&_nc_ht=scontent-mad2-1.xx&oh=00_AfDkI8xix4ekR-gv0ZYsaRvKPSWlUTudbsdlbWL-BCsUwA&oe=66354FD1" width="30%" height="30%">
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sem dui, condimentum aliquam accumsan eget, interdum non urna. Nam at enim mauris. Nunc egestas felis et ipsum ultrices, ac iaculis odio consequat. Vivamus a metus lorem. Donec tincidunt, ipsum ut efficitur tristique, dolor ex tempus dui, pulvinar malesuada dui dui vitae libero. Duis in mattis diam, ac tincidunt tellus. In hac habitasse platea dictumst. Sed libero orci, rutrum eget lacinia eget, commodo quis risus. Mauris vitae sapien aliquam, laoreet sapien ut, dignissim dolor. Vestibulum condimentum, augue id venenatis imperdiet, tellus quam cursus lorem, suscipit rhoncus diam purus quis ex. Fusce viverra, felis ac consectetur ultricies, sem libero tincidunt felis, eget efficitur diam leo at sapien. Fusce eu efficitur enim. Duis posuere mi sed suscipit cursus. Maecenas semper, ligula vel fringilla hendrerit, tortor mi sollicitudin eros, sed elementum dolor nulla at metus. Integer tincidunt dignissim diam, sed sodales mauris fringilla feugiat. <br> <br><br>

    Etiam nibh augue, sollicitudin dignissim posuere et, porttitor in tellus. Proin dapibus odio nec eleifend posuere. Suspendisse id erat venenatis, consequat purus quis, cursus massa. Cras consectetur nisi non massa congue mollis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam lorem enim, consectetur eget odio eget, facilisis facilisis purus. Maecenas sit amet ultricies lectus, nec facilisis magna. Integer aliquet rutrum risus, quis pretium eros gravida non. <br><br><br>
    
    Praesent sit amet urna justo. Maecenas nec blandit sem. Sed elementum sed arcu nec eleifend. Aliquam a ultricies ligula, sed gravida est. Donec nec interdum magna. Phasellus maximus ipsum non tellus euismod, id ornare quam porttitor. Maecenas interdum est nec vehicula rhoncus. Etiam efficitur nulla sit amet dolor feugiat rhoncus.</p>
<h2>¿DÓNDE NOS PUEDES ENCONTRAR?</h2> 
<div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2968.687521402599!2d-4.490210984557543!3d41.92107567921872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd47aeaf83ff78a1%3A0x3756de50f54fe8c7!2sPanaderia%20Tina!5e0!3m2!1ses!2ses!4v1647419873270!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div> 

<br><br><br><br><br>
<h3>MISIÓN</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mollis eu lectus vel scelerisque. Nullam nulla eros, mattis vel mauris at, ultricies pellentesque leo. Ut ut odio at purus varius ornare. Fusce condimentum et dui vel vulputate. Aliquam ac turpis id massa auctor sollicitudin. Etiam dignissim dolor eu lorem sollicitudin interdum. In faucibus nibh at nunc convallis, in interdum sapien consequat. Mauris tempor nec ante at fringilla. Aenean nec augue ac risus dictum suscipit et at nisi. Phasellus rutrum lectus felis, tempor pharetra nunc iaculis ac. Quisque neque ex, pellentesque eget purus at, faucibus laoreet arcu.</p>
<H3>VISIÓN</H3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mollis eu lectus vel scelerisque. Nullam nulla eros, mattis vel mauris at, ultricies pellentesque leo. Ut ut odio at purus varius ornare. Fusce condimentum et dui vel vulputate. Aliquam ac turpis id massa auctor sollicitudin. Etiam dignissim dolor eu lorem sollicitudin interdum. In faucibus nibh at nunc convallis, in interdum sapien consequat. Mauris tempor nec ante at fringilla. Aenean nec augue ac risus dictum suscipit et at nisi. Phasellus rutrum lectus felis, tempor pharetra nunc iaculis ac. Quisque neque ex, pellentesque eget purus at, faucibus laoreet arcu.</p>
<H3>VALORES</H3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mollis eu lectus vel scelerisque. Nullam nulla eros, mattis vel mauris at, ultricies pellentesque leo. Ut ut odio at purus varius ornare. Fusce condimentum et dui vel vulputate. Aliquam ac turpis id massa auctor sollicitudin. Etiam dignissim dolor eu lorem sollicitudin interdum. In faucibus nibh at nunc convallis, in interdum sapien consequat. Mauris tempor nec ante at fringilla. Aenean nec augue ac risus dictum suscipit et at nisi. Phasellus rutrum lectus felis, tempor pharetra nunc iaculis ac. Quisque neque ex, pellentesque eget purus at, faucibus laoreet arcu.</p>
</body>
 </html>