<!DOCTYPE html>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];
    $pass = $_POST['pass']; // Obtener la contraseña del formulario
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $telefono = $_POST['telefono'];

    // Hashear la contraseña
    $pass_hasheada = password_hash($pass, PASSWORD_DEFAULT); // Hashear la contraseña

    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "panaderia";
    
    $obj_conexion = mysqli_connect($servername, $username, $password, $dbname);
    if (!$obj_conexion) {
        echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
    } else {      
      
        $var_consulta = "UPDATE clientes SET "
                       . "correo=?, pass=?, nombre=?, apellido1=?, apellido2=?, telefono=? "
                       . "WHERE dni=?";

        $stmt = $obj_conexion->prepare($var_consulta);
        $stmt->bind_param("sssssss", $correo, $pass_hasheada, $nombre, $apellido1, $apellido2, $telefono, $dni);

        if ($stmt->execute()) {
            echo "<h3>Usuario Modificado</h3>";
        } else {
            echo "Error al modificar el usuario: " . $stmt->error;
        }

        $stmt->close();
        $obj_conexion->close();
    }
}
?>

<br>
<a href="usuarios_admin.php" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Página principal</a>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
