<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cliente</title>
</head>
<body>
    <h2>Registro de Cliente</h2>
    <form action="validar_registro.php" method="post">
        <label for="dni">DNI:</label>
        <input type="text" name="dni" required><br>

        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" required><br>

        <label for="pass">Contraseña:</label>
        <input type="password" name="pass" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellido1">Primer apellido:</label>
        <input type="text" name="apellido1" required><br>

        <label for="apellido2">Segundo apellido:</label>
        <input type="text" name="apellido2" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>