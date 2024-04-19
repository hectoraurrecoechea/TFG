<?php
session_start(); // Iniciar la sesión

// Eliminar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redireccionar a index.php
header("Location: ../index.php");
exit;
?>