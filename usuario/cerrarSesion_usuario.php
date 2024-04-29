<?php
// Iniciar sesión si no está iniciada
session_start();

// Destruir todas las variables de sesión
//$_SESSION = array();

// Finalmente, se destruye la sesión
session_destroy();

// Deshabilitar la caché del navegador
session_cache_limiter('nocache');

// Redirigir al usuario a login.php
header("Location: ../index.php");
exit();
?>