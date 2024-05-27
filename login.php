<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['dni'];
    $pass = $_POST['pass'];

    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $database = "panaderia";

    // Conexión a la base de datos usando MySQLi
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta preparada para evitar SQL Injection
    $sql = "SELECT dni, rol, correo, pass, nombre, apellido1, apellido2, telefono FROM clientes WHERE dni = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña hasheada
        if (password_verify($pass, $row['pass'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['dni'] = $dni;
            $_SESSION['rol'] = $row['rol'];
            $_SESSION['usuario'] = $row; // Almacenar todos los datos del usuario en la sesión

            // Redirigir según el rol del usuario
            if ($row['rol'] == 'administrador') {
                header("location: administrador/usuarios_admin.php");
            } else {
                header("Location: usuario/index_usuario.php");
            }
            exit;
        } else {
            // Contraseña incorrecta
            $_SESSION['login_error'] = true;
            header("Location: index.php");
            exit;
        }
    } else {
        // Usuario no encontrado
        $_SESSION['login_error'] = true;
        header("Location: index.php");
        exit;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
