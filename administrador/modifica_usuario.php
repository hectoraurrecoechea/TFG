<!DOCTYPE html>
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <title>Modifica usuario</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <title>Modifica usuario</title>
  </head>
  <body>
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
            &nbsp;&nbsp;<a href="..\index.php" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Cancelar</a>
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>Aceptar</button><br><br>
          </form>
      </div>
      <div class="text-center">&copy; Centro Don Bosco</div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>