<?php
session_start();
session_destroy(); // Destruir la sesión actual
header("Location: index.php"); // Redirigir al inicio de sesión
exit();
?>
