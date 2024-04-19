<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenidos!</title>
    <link rel="stylesheet" href="style.css">
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
            <li><a href="configuracion.php">CONFIGURACION</a></li>
            <li><a href="contacto.php">CONTACTO</a></li>
            <li><a href="buscar.php">BUSCAR PRODUCTO</a></li>
         </nav>
     </div>
 </header>
 <?php 
   $a = session_id();
   if(empty($a)) {
     session_start();
   }
   $row["dni"]=$_GET["dni"];
   $row["pass"]=$_GET["pass"];
   $row["correo"]=$_GET["correo"];
   $row["nombre"]=$_GET["nombre"];
   $row["apellido1"]=$_GET["apellido1"];
   $row["apellido2"]=$_GET["apellido2"];
   $row["telefono"]=$_GET["telefono"];
  ?>
    <div class="container">
      <br><br>
      <div class="panel panel-info">
        <div class="panel-heading text-center">Modificación de usuario</div>
          <form method="get" action="usuario_modificado.php">
            <div class="form-group"> 
              <label>&nbsp;&nbsp;DNI:&nbsp;</label><input type="text" size="7" name="dni" value="<?php echo $row["dni"] ?>" readonly>
            </div>
            <div class="form-group">
            <label>&nbsp;&nbsp;PASS&nbsp;</label><input type="text" size="35" name="pass" value="<?php echo $row["pass"]; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;CORREO&nbsp;</label><input type="text" name="correo" size="20" value="<?php echo $row["correo"]; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;NOMBRE&nbsp;</label><input type="text" name="nombre" size="20" value="<?php echo $row["nombre"]; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;APELLIDO1&nbsp;</label><input type="text" name="apellido1" size="20" value="<?php echo $row["apellido1"]; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;APELLIDO2&nbsp;</label><input type="text" name="apellido2" size="20" value="<?php echo $row["apellido2"]; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;TELEFONO&nbsp;</label><input type="text" name="telefono" size="20" value="<?php echo $row["telefono"]; ?>">
            </div>
            <hr>
            &nbsp;&nbsp;<a href="usuarios_admin.php" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Cancelar</a>
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>Aceptar</button><br><br>
          </form>
      </div>
      <div class="text-center">&copy; Centro Don Bosco</div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
 </html>