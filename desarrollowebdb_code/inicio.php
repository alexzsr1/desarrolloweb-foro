<?php
session_start();

if (!isset($_SESSION["loggedin"])) {
    header('Location: index.html');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
    body{
    font-family: Arial;
    box-sizing: border-box;
    background-color: black;
}

.navtop {
	background-color: darkblue;
	height: 70px;
	width: 100%;
	border: 0;
}

.navtop h1 {
	flex: 1;
	font-size: 24px;
	padding: 8px;
	margin: 0;
    text-align: center;
    color: #ffffff;
	font-weight: bold;
}
.navtop a {
	padding: 8px;
	text-decoration: none;
	color: white;
	font-weight: bold;
}
.navtop a i {
	padding: 2px 8px 0 0;
}
.navtop a:hover {
	color: #eaebed;
}
body.loggedin {
	background-color: #f3f4f7;
}
.content {
	width: 100%;
	margin: 0 auto;
}
.content h2 {
	margin: 0;
	padding: 25px 0;
	font-size: 22px;
	border-bottom: 1px solid #e0e0e3;
	color: #4a536e;
}
</style>

<body class="loggedin">
    <nav class="navtop">
        <h1>¡Bienvenido!</h1>

        <a href="perfil.php"><i class="fas fa-user-circle"></i>Información de Usuario</a>
        <a href="cerrar-sesion.php"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>
    </nav>

    <div class="content">
        <h2>Página de Inicio</h2>
        <p>Hola, <?= $_SESSION['nombre']?>!!</p>
    </div>
</body>
</html>