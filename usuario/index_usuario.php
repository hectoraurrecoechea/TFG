<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../index.php");
    exit;
}


if ($_SESSION['rol'] == 'administrador') {
     echo "Bienvenido, Administrador!";
} else {
    echo "Bienvenido, Usuario!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenidos!</title>
    <link rel="stylesheet" href="style_index.css">
    <style>
            
    
    </style>
</head>
<body>
<h1>Bienvenido, <?php echo $_SESSION['dni']; ?></h1>
 <header>
     <div class="container">
         <p class="logo">Panaderia Tina</p>
         <nav>
            <li><a href="index_usuario.php">INICIO</a></li>
            <li><a href="productos.php">PRODUCTOS</a></li>
            <li><a href="fotos.php">FOTOGRAFÍAS</a></li>
            <li><a href="historia.php">NUESTRA HISTORIA</a></li>
            <li><a href="configuracion.php">CONFIGURACION</a></li>
            <li><a href="contacto.php">CONTACTO</a></li>
            <li><a href="buscar.php">BUSCAR PRODUCTO</a></li>
            <li><a href="cerrarSesion_usuario.php">Cerrar sesion</a></li>
         </nav>
     </div>
 </header>




 <section id="hero">
     <H1>LA MEJOR <br> PANADERIA Y REPOSTERIA</H1>
     <button><a href="../REGISTRARSE/registro.html">REGÍSTRATE</a></button>
 </section>

 <section id="nuestros-productos">
     <div class="container">
     <h2>NUESTROS PRODUCTOS</h2>
     <div class="productos">
     <div class="carta">
         <h3><a href="../GALERIA DE FOTOGRAFIAS/galeria.html#panpan">PAN</a></h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
     </div>
     <div class="carta">
         <h3><a href="../GALERIA DE FOTOGRAFIAS/galeria.html#frutas">FRUTAS Y VERDURAS </a></h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
     </div>
     <div class="carta">
         <h3><a href="../GALERIA DE FOTOGRAFIAS/galeria.html#dulces">DULCES </a></h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
     </div>
    </div>
    </div>
 </section>

 <section id="pedido">
     <h2>¿YA TIENES PENSADO QUE PEDIR?</h2>
     <button><a href="../PRODUCTOS/productos.html">REALIZA TU PEDIDO</a></button>
 </section>
 <div class="mapa">
    <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2968.687521402599!2d-4.490210984557543!3d41.92107567921872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd47aeaf83ff78a1%3A0x3756de50f54fe8c7!2sPanaderia%20Tina!5e0!3m2!1ses!2ses!4v1647419873270!5m2!1ses!2ses"
        frameborder="0"
        style="border:0;"
        allowfullscreen=""
        aria-hidden="false"
        tabindex="0"
    ></iframe>
</div>
 <footer>
     <div class="container">
         <p>ESPERAMOS QUE OS HAYA GUSTADO, ¡NOS VEMOS PRONTO!</p>
    </div>
 </footer>
</body>
</html>