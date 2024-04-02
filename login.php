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
$pass = $_POST['pass'];

// Consulta SQL para verificar el usuario
$sql = "SELECT * FROM clientes WHERE dni='$dni' && pass='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuario encontrado, verificar contraseña
    $row = $result->fetch_assoc();
    if ( $pass == $row['pass']) {
        // Contraseña correcta, iniciar sesión
        session_start();
        $_SESSION['dni'] = $dni;
        $_SESSION['rol'] = $row['rol'];
        if ($_SESSION['rol'] == 'administrador') {
            header("Location: administrador/usuarios_admin.php"); // Redirigir al panel de administrador
        } else {
            header("Location: usuario/index_usuario.php"); // Redirigir al panel de usuario
        }
        exit();
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}

// Cerrar conexión
$conn->close();
?>