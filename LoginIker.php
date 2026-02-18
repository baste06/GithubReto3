<?php
$nombre = $_POST["nombre"];
$contrasena = $_POST["contrasena"];

$usuarios = " El nombre es: " . $nombre . "\n";
$datosU = fopen ("usuarios.txt", "r");

$usuarios = " La contraseña es: " . $contrasena . "\n";
$datosC = fopen("contrasenas.txt", "r");
$autenticado = false;

while (!feof($datosU) && !feof($datosC)) {
    $usuarioLinea = trim(fgets($datosU));
    $contrasenaLinea = trim(fgets($datosC));

    if ($usuarioLinea == $nombre && $contrasenaLinea == $contrasena) {
        $autenticado = true;
        break;
    }
}

if ($autenticado == true) {
    echo "Login Correcto";
} else {
    echo "Usuario o Contraseña incorrecto";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Dancing+Script:wght@400..700&family=Honk:MORF@15&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mountains+of+Christmas:wght@400;700&display=swap" rel="stylesheet">

    <title>Sesion inciada</title>
</head>
<body class="cuadro">
    
</body>
</html>

<?php
