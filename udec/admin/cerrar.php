<?php
session_start();

// destruir la sesión
session_destroy();

// eliminar todos los datos de la sesión
session_unset();

// redirigir a la página de inicio de sesión
header("location: ./login.php");
exit();

?>