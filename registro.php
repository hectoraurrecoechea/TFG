<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cliente</title>
    <link rel="stylesheet" href="estiloRegistro.css">
</head>
<body>
    <div class="formulario">
        <form action="validar_registro.php" method="post">
            <h2>Registro de Cliente</h2>
            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" name="dni" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="email" name="correo" required>
            </div>

            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password" name="pass" required>
            </div>

            <div class="form-group">
                <label for="pass_confirm">Confirmar Contraseña:</label>
                <input type="password" name="pass_confirm" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido1">Primer apellido:</label>
                <input type="text" name="apellido1" required>
            </div>

            <div class="form-group">
                <label for="apellido2">Segundo apellido:</label>
                <input type="text" name="apellido2" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" required>
            </div>

            <input type="submit" value="Registrar">
            <a href="index.php">Volver a inicio</a>
        </form>
    </div>
</body>
</html>
