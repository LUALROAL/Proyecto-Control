

<?php
define("APP_PATH", $_SERVER["DOCUMENT_ROOT"] . "/control/");
session_start();
require_once APP_PATH . 'consultasDatabase.php';

$nombre = $_POST["txtusuario"];
$pass = $_POST["txtpassword"];
$usuario = login($nombre, $pass);
if ($usuario == "") {
    header("Location: index.html");
} else {

    session_regenerate_id();
    $_SESSION['loggedin'] = true;
    $_SESSION['name'] = $usuario;
    $_SESSION['id'] = $usuario;
    header('Location: inicio.php');
}

?>