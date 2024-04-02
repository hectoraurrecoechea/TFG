<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['dni'])) {
    header("Location: login.html"); // Redirigir al formulario de inicio de sesión si no ha iniciado sesión
    exit();
}

// Mostrar contenido de la página de inicio
echo "Bienvenido, ".$_SESSION['dni']."!";
?>