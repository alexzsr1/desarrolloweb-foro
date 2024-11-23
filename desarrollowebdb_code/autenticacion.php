<?php
session_start();

//Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'desarrollowebdb_lapo';

$conexion = mysqli_connect($host, $user, $password, $database);

//Si se encuentra fallo
if (!$conexion) {
    die("Fallo en la conexión de MySQL: ".mysqli_connect_error());
}

//Se valida si se ha enviado información, si no hay muestra error y redirecciona a la pagina de inicio
if (!isset($_POST["usuario"], $_POST["clave"])) {
    header("Location: index.html");
    exit;
}

//Evitar inyección sql (Seguridad)
if ($stmt = $conexion->prepare("SELECT id, clave FROM usuarios WHERE usuario = ?")) {
        $stmt->bind_param('s', $_POST['usuario']);
        $stmt->execute();


//Verificar que los datos ingresados coinciden en la base de datos
$stmt->store_result();

if ($stmt->num_rows() > 0) {
    $stmt->bind_result($id, $clave);
    $stmt->fetch();

if($_POST['clave'] === $clave) {
    session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['nombre'] = $_POST['usuario'];
        $_SESSION['id'] = $id;
    header('Location: inicio.php');
    exit;
} else {
    header('Location: index.html');
    exit;
    }
}
    $stmt->close();
}