<?php
session_start();

if (!isset($_SESSION["loggedin"])) {
    header('Location: index.html');
    exit;
}

//Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'desarrollowebdb_lapo';

$conexion = mysqli_connect($host, $user, $password, $database);

//Si se encuentra fallo muestra error
if (!$conexion) {
    die("Fallo en la conexión de MySQL: ".mysqli_connect_error());
}

//Obtener datos de la BD
$stmt = $conexion->prepare( "SELECT nombre, apellido, usuario, correo, clave FROM usuarios WHERE id = ?");

$stmt->bind_param("i", $_SESSION["id"]);
$stmt->execute();
$stmt->bind_result($nombre, $apellido, $usuario, $correo, $clave);
if ($stmt->fetch());
$stmt->close();



mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
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
.content > p, .content > div {
	box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);
	margin: 25px 0;
	padding: 25px;
	background-color: #fff;
}
.content > p table td, .content > div table td {
	padding: 5px;
}
.content > p table td:first-child, .content > div table td:first-child {
	font-weight: bold;
	color: #4a536e;
	padding-right: 15px;
}
.content > div p {
	padding: 5px;
	margin: 0 0 10px 0;
}
</style>

<body class = "loggedin">
    <nav class = "navtop">
        <h1>Información de Usuario</h1>
        <a href="inicio.php">Inicio</a>
        <a href="cerrar-sesion.php"><i class = "fas fa-sign-out-alt"></i>Cerrar Sesión</a>
    </nav>

    <div class = "content">
        <h2>Información del Usuario</h2>

        <div>
            <p>La siguiente información esta registrada en tu cuenta: </p>
            <table>
            <tr>
                <td>Nombres:</td>
                <td><?php echo htmlspecialchars($nombre. " ".$apellido); ?></td>
            </tr>
            <tr>
                <td>Usuario:</td>
                <td><?php echo htmlspecialchars($usuario); ?></td>
            </tr>
            <tr>
                <td>Correo electronico:</td>
                <td><?php echo htmlspecialchars($correo); ?></td>
            </tr>
            </table>
        </div>
    </div>
</body>
</html>