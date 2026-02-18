<?php
session_start();

$_SESSION = [];          // Vacía la sesión
session_destroy();       // Destruye la sesión
session_regenerate_id(true); // Evita problemas de sesión

header("Location: login.php");
exit();
