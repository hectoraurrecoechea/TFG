<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['dni'];
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $pass_confirm = $_POST['pass_confirm'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $telefono = $_POST['telefono'];

    // Validación básica
    if (!preg_match('/^\d{8}[a-zA-Z]$/', $dni)) {
        echo "El DNI debe tener ocho números seguidos de una letra.";
        exit;
    }

    if (!preg_match('/^\d{9}$/', $telefono)) {
        echo "El número de teléfono debe tener nueve números.";
        exit;
    }

    if ($pass != $pass_confirm) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "panaderia";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Comprobación de existencia de DNI y correo
    $sql_dni = "SELECT * FROM clientes WHERE dni = ?";
    $stmt_dni = $conn->prepare($sql_dni);
    $stmt_dni->bind_param("s", $dni);
    $stmt_dni->execute();
    $result_dni = $stmt_dni->get_result();

    $sql_correo = "SELECT * FROM clientes WHERE correo = ?";
    $stmt_correo = $conn->prepare($sql_correo);
    $stmt_correo->bind_param("s", $correo);
    $stmt_correo->execute();
    $result_correo = $stmt_correo->get_result();

    if ($result_dni->num_rows > 0 || $result_correo->num_rows > 0) {
        $_SESSION['dni_existente'] = $result_dni->num_rows > 0;
        $_SESSION['correo_existente'] = $result_correo->num_rows > 0;
        header("Location: repetir.php");
        exit;
    } else {
        // Inserción de datos
        $sql_insert = "INSERT INTO clientes (dni, correo, pass, nombre, apellido1, apellido2, telefono, rol) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, 'usuario')";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sssssss", $dni, $correo, $pass, $nombre, $apellido1, $apellido2, $telefono);
        
        if ($stmt_insert->execute()) {
            echo "El usuario se ha registrado correctamente.";
            ?>
            <a href="index.php">Volver a inicio</a>
            <?php
        } else {
            echo "Error al registrar el usuario: " . $stmt_insert->error;
        }
    }
    
    // Cierre de conexiones y preparaciones
    $stmt_dni->close();
    $stmt_correo->close();
    $stmt_insert->close();
    $conn->close();
}
?>
