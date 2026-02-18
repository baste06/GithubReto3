<?php
session_start();
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $consulta = $conn->prepare(
        "SELECT password FROM usuarios WHERE usuario = ?"
    );
    $consulta->bind_param("s", $usuario);
    $consulta->execute();
    $consulta->store_result();

    if ($consulta->num_rows === 1) {
        $consulta->bind_result($hash);
        $consulta->fetch();

        if (password_verify($password, $hash)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: chat.php");
            exit();
        } else {
            $error = "❌ Contraseña incorrecta";
        }
    } else {
        $error = "❌ Usuario no existe";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">

<div class="auth-container">
    <h2>Iniciar sesión</h2>

    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>

    <div class="auth-error"><?php echo $error; ?></div>

    <a href="registro.php">¿No tienes cuenta? Regístrate</a>
</div>

</body>
</html>
