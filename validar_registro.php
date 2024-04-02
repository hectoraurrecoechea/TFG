<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "panaderia";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$dni = $_POST['dni'];
$correo = $_POST['correo'];
$pass = $_POST['pass']; // Hash de la contraseña
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$telefono = $_POST['telefono'];

// Insertar datos en la tabla clientes
$sql = "INSERT INTO clientes (dni, correo, pass, nombre, apellido1,apellido2, telefono,rol)
VALUES ('$dni', '$correo', '$pass', '$nombre', '$apellido1', '$apellido2', '$telefono','usuario')";

if ($conn->query($sql) === TRUE) {
    header("location:index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>