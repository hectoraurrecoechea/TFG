<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">
        <h1>PANADERIA TINA</h1>
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="dni">DNI:</label>
                    <input type="text" id="dni" name="dni" required>
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña:</label>
                    <input type="password" id="pass" name="pass" required>
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <p>¿No estás registrado? <a href="registro.php">Regístrate aquí</a>.</p><br>
            <p>¿Has olvidado la contraseña?<a href="cambiarContrasena.php">Cambiar contraseña</a></p>
        </div>
    </div>
</body>
</html>
