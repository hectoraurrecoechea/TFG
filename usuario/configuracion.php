<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../index.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "12345";
$database = "panaderia";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if ($_SESSION['rol'] == 'administrador') {
    echo "Bienvenido, Administrador!";
} else {
    //echo "Bienvenido, Usuario!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST["dni"];
    $pass = $_POST["pass"];
    $correo = $_POST["correo"];
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $telefono = $_POST["telefono"];

    $sql = "UPDATE clientes SET pass='$pass', correo='$correo', nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', telefono='$telefono' WHERE dni='$dni'";

    if ($conn->query($sql) === TRUE) {
        echo "Datos actualizados correctamente.";
        $_SESSION['usuario']['pass'] = $pass;
        $_SESSION['usuario']['correo'] = $correo;
        $_SESSION['usuario']['nombre'] = $nombre;
        $_SESSION['usuario']['apellido1'] = $apellido1;
        $_SESSION['usuario']['apellido2'] = $apellido2;
        $_SESSION['usuario']['telefono'] = $telefono;
    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenidos!</title>
    <link rel="stylesheet" href="style_configuracion.css">
    <!-- Otros enlaces a archivos CSS -->
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
    <div class="container">
      <br><br>
      <div class="panel panel-info">
        <div class="panel-heading text-center">Modificación de usuario</div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group"> 
              <label>&nbsp;&nbsp;DNI:&nbsp;</label><input type="text" size="7" name="dni" value="<?php echo $_SESSION['usuario']['dni'] ?>" readonly>
            </div>
            <div class="form-group">
            <label>&nbsp;&nbsp;PASS&nbsp;</label><input type="password" size="35" name="pass" value="<?php echo $_SESSION['usuario']['pass']; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;CORREO&nbsp;</label><input type="text" name="correo" size="20" value="<?php echo $_SESSION['usuario']['correo']; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;NOMBRE&nbsp;</label><input type="text" name="nombre" size="20" value="<?php echo $_SESSION['usuario']['nombre']; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;APELLIDO1&nbsp;</label><input type="text" name="apellido1" size="20" value="<?php echo $_SESSION['usuario']['apellido1']; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;APELLIDO2&nbsp;</label><input type="text" name="apellido2" size="20" value="<?php echo $_SESSION['usuario']['apellido2']; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;TELEFONO&nbsp;</label><input type="text" name="telefono" size="20" value="<?php echo $_SESSION['usuario']['telefono']; ?>">
            </div>
            <hr>
            &nbsp;&nbsp;<a href="index_usuario.php" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Cancelar</a>
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>Aceptar</button><br><br>
          </form>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
 </html>
