<!DOCTYPE html>
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <title>Modifica producto</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <title>Modifica prodcuto</title>
  </head>
  <body>
  <?php 
   $a = session_id();
   if(empty($a)) {
     session_start();
   }
   $row["id_producto"]=$_GET["id_producto"];
   $row["nombre_producto"]=$_GET["nombre_producto"];
   $row["descripcion"]=$_GET["descripcion"];
   $row["precio"]=$_GET["precio"];
   $row["id_categoria"]=$_GET["id_categoria"];
  ?>
    <div class="container">
      <br><br>
      <div class="panel panel-info">
        <div class="panel-heading text-center">Modificación de producto </div>
          <form method="get" action="producto_modificado.php">
            <div class="form-group"> 
              <label>&nbsp;&nbsp;id_producto:&nbsp;</label><input type="text" size="7" name="id_producto" value="<?php echo $row["id_producto"] ?>" readonly>
            </div>
            <div class="form-group">
            <label>&nbsp;&nbsp;Nombre&nbsp;</label><input type="text" size="35" name="nombre_producto" value="<?php echo $row["nombre_producto"]; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;Descripcion&nbsp;</label><input type="text" name="descripcion" size="150" value="<?php echo $row["descripcion"]; ?>">
            </div>
            <div class="form-group">
             <label>&nbsp;&nbsp;Precio&nbsp;</label><input type="text" name="precio" size="15" value="<?php echo $row["precio"]; ?>">
            </div>
            <div class="form-group"> 
              <label>&nbsp;&nbsp;id_categoria:&nbsp;</label><input type="text" size="7" name="id_categoria" value="<?php echo $row["id_categoria"] ?>">
            </div>
            
            <hr>
            &nbsp;&nbsp;<a href="productos_admin.php" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Cancelar</a>
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