<?php
session_start(); // 🔴 SIEMPRE LA PRIMERA LÍNEA
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar si existe
    $consulta = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
    $consulta->bind_param("s", $usuario);
    $consulta->execute();
    $consulta->store_result();

    if ($consulta->num_rows > 0) {
        $error = "❌ El usuario ya existe";
    } else {

        // Insertar
        $insertar = $conn->prepare(
            "INSERT INTO usuarios (usuario, password) VALUES (?, ?)"
        );
        $insertar->bind_param("ss", $usuario, $password);

        if ($insertar->execute()) {

            // 🔥 INICIAR SESIÓN AUTOMÁTICA
            $_SESSION['usuario'] = $usuario;

            header("Location: chat.php");
            exit();
        } else {
            $error = "❌ Error al registrar";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">

<div class="auth-container">
    <h2>Crear cuenta</h2>

    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
    </form>

    <div class="auth-error"><?php echo $error; ?></div>

    <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
</div>

</body>
</html>
