<?php
session_start();
include "db.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_POST) {
    $msg = $_POST['mensaje'];
    $user = $_SESSION['usuario'];
    $conn->query("INSERT INTO mensajes (usuario, mensaje) VALUES ('$user','$msg')");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="chat-container">

    <div class="chat-header">
        Chat - <?php echo $_SESSION['usuario']; ?>
    </div>

        <div class="chat-messages">
        <?php
        $res = $conn->query("SELECT * FROM mensajes ORDER BY fecha ASC");

        while ($row = $res->fetch_assoc()) {

            $clase = ($row['usuario'] == $_SESSION['usuario']) ? "me" : "other";
            $fecha = date("H:i · d/m/Y", strtotime($row['fecha']));

            echo "<div class='message $clase'>
                <div class='user'>{$row['usuario']}</div>
                <div class='text'>{$row['mensaje']}</div>
                <div class='date'>{$fecha}</div>
                </div>";
}
?>
</div>


    <form method="POST" class="chat-form">
        <input type="text" name="mensaje" placeholder="Escribe un mensaje..." required>
        <button>➤</button>
    </form>

    <div class="logout">
        <a href="logout.php">Cerrar sesión</a>
    </div>

</div>

</body>
</html>
