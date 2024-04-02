<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="login.php" method="post">
        <label for="dni">DNI:</label>
        <input type="text" name="dni" required><br>
        <label for="pass">Contraseña:</label>
        <input type="password" name="pass" required><br>
        <input type="submit" value="Iniciar sesión">
    </form>
    <p>¿Todavia no tienes cuenta?<a href="registro.php">REGISTRATE</a></p>
</body>
</html>