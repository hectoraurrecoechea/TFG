<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $dni = $_POST['dni'];
    $pass = $_POST['pass'];

    
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $database = "panaderia";

    
    $conn = new mysqli($servername, $username, $password, $database);

    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    
    $sql = "SELECT  dni, rol FROM clientes WHERE dni = '$dni' AND pass = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        
        $row = $result->fetch_assoc();

        $_SESSION['loggedin'] = true;
        $_SESSION['dni'] = $dni;
        $_SESSION['rol'] = $row['rol'];
        //PONER TIEMPO DE INICIO Y CERRAR SESION

        
        if ($row['rol'] == 'administrador') {
            header("location: administrador/usuarios_admin.php");
        } else {
            header("Location: usuario/index_usuario.php");
        }
        exit;
    } else {
        $error_message = "DNI o contraseña incorrectos";
    }

    $conn->close();
}
?>
