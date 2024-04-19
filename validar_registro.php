<?php

$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "panaderia";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];
    $pass = $_POST['pass']; 
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $telefono = $_POST['telefono'];

    // Consulta para verificar si el número de teléfono ya existe en la base de datos
    $sql = "SELECT * FROM clientes WHERE telefono = '$telefono'";
    $result = $conn->query($sql);

    // Verificar si se encontró algún resultado (es decir, si el número de teléfono ya existe)
    if ($result->num_rows > 0) {
        // Redirigir al usuario a la página repetir.php
        header("Location: repetir.php");
        exit; // Asegurarse de que el script se detenga después de redirigir
    } else {
        // Si el número de teléfono no existe, proceder con la inserción en la base de datos
        // Por ejemplo:
        $sql_insert = "INSERT INTO clientes (dni, correo, pass, nombre,apellido1,apellido2,telefono,rol) 
        VALUES ('$dni', '$correo', '$pass', '$nombre', '$apellido1', '$apellido2','$telefono', 'usuario')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "El usuario se ha registrado correctamente.";
            ?>
            <a href="index.php">Volver a inicio</a>
            <?php
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }
    }
}
?>





