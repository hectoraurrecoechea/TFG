<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  </head>
  <body>


  <?php
$row["id_producto"]=$_GET["id_producto"];
$row["nombre_producto"]=$_GET["nombre_producto"];
$row["descripcion"]=$_GET["descripcion"];
$row["precio"]=$_GET["precio"];
$row["id_categoria"]=$_GET["id_categoria"];

$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "panaderia";
    
    
        $obj_conexion = 
        mysqli_connect($servername, $username, $password, $dbname);
        if(!$obj_conexion)
        {
          echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
        } else {      


          $var_consulta=   "UPDATE productos SET "
                           . "id_producto='" . $row["id_producto"]
                           . "', nombre='" . $row["nombre_producto"]
                           . "', descripcion='" . $row["descripcion"]
                           . "', precio='" . $row["precio"]
                           . "', id_categoria='" . $row["id_categoria"]
                           . "' WHERE id_producto='" . $row["id_producto"]
                           . "'";

          //$var_resultado = $obj_conexion->query($var_consulta);
          
          
          $stmt = $obj_conexion->prepare($var_consulta);

          echo "<h3>Prodcuto modificada</h3>";
          $stmt->execute();
          $stmt->close();

        }
        
    ?>

    
    <br>
    <a href="productos_admin.php" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Volver a productos</button>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>