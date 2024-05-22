<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pedido</title>
    <link rel="stylesheet" href="estilos_confirmacion.css">
</head>
<body>
    <div class="confirmation-box">
        <h1>Pedido realizado correctamente</h1>
        <h3>¿Cómo quiere pagar?</h3>
        <p><strong>Por Bizum:</strong> 607 92 28 80</p>
        <p><strong>En efectivo en el local</strong></p>
        <a href="productos.php" class="return-link">Volver a Productos</a>
    </div>
</body>
</html>

