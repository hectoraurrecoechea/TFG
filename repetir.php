<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Repetir</title>
</head>
<body>

<?php
if (isset($_SESSION['telefono_existente']) && $_SESSION['telefono_existente']) {
    echo "<h2>Ya existe un usuario con el número de teléfono proporcionado.</h2>";
}
if (isset($_SESSION['dni_existente']) && $_SESSION['dni_existente']) {
    echo "<h2>Ya existe un usuario con el DNI proporcionado.</h2>";
}
if (isset($_SESSION['correo_existente']) && $_SESSION['correo_existente']) {
    echo "<h2>Ya existe un usuario con el correo electrónico proporcionado.</h2>";
}
?>

<a href="registro.php">Volver a registro</a>

</body>
</html>
