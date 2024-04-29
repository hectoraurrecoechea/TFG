<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['dni'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $database = "panaderia";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el DNI existe en la base de datos
    $sql = "SELECT dni FROM clientes WHERE dni = '$dni'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Actualizar la contraseña en la base de datos
        $update_sql = "UPDATE clientes SET pass = '$new_password' WHERE dni = '$dni'";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "Contraseña actualizada correctamente.";
        } else {
            echo "Error al actualizar la contraseña: " . $conn->error;
        }
    } else {
        echo "El DNI no existe en la base de datos.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <h2>Cambiar Contraseña</h2>
    <form action="cambiarcontrasena.php" method="post">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br><br>
        <label for="new_password">Nueva Contraseña:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <label for="confirm_password">Confirmar Contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <input type="submit" value="Cambiar Contraseña">
    </form>
    <a href="index.php">Volver</a>
</body>
</html>
