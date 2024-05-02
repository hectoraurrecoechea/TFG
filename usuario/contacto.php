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
    <link rel="stylesheet" href="style_contacto.css">
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
.container2 {
    max-width: 1000px; /* ajusta el ancho máximo según sea necesario */
    margin: 0 auto; /* establece el margen izquierdo y derecho automáticamente para centrar */
    padding: 20px; /* añade un relleno para espacio interior */
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
 <div class="container2">
    <ul>
        <p><img src="imagenes/whatsap.jpg" width="30px" height="20px"> TELÉFONO: 661907543</p>
        <p><img src="imagenes/instagram.jpg" width="30px" height="20px">INSTAGRAM: PanaderiaTina VentaDeBaños</p>
        <p><img src="imagenes/telefono.png" width="30px" height="20px"> NÚMERO TIENDA:979775578</p>
        <p><img src="imagenes/correo e.png" width="30px" height="20px"> CORREO: tupanaderiadeconfianza@hotmail.com</p>
        <p><img src="imagenes/twiter.png" width="30px" height="20px"> TWITER: PanaderiaTina2010</p>
        <p><img src="imagenes/facebook.png" width="30px" height="20px"><a href="https://m.facebook.com/Panader%C3%ADa-Tina-118683468689693/"> FACEBOOK: PanaderiaTina2010</a></p>

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
    </ul>
</div>
<br><br><br><br><br>
</body>
</html>