
<?php
define("APP_PATH", $_SERVER["DOCUMENT_ROOT"] . "/control/");
require_once APP_PATH . 'Config.php';

//define('APP_PATH', ROOT . DS);
//require_once APP_PATH.'Config.php';
// We need to use sessions, so you should always start sessions using the below code.
// If the user is not logged in redirect to the login page...


if (session_id() === '' ? FALSE : TRUE) {
    header('Location:' . APP_PATH . 'index.php');
    exit;
}
session_start();
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $conn->prepare('SELECT usuario,password FROM login WHERE usuario = ?');

// In this case we can use the account ID to get the account info.
$stmt->bind_param('s', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($usuario, $password);
$stmt->fetch();
$stmt->close();

?>

<DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="author" content="David">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta nane="keyboards" content="control">
        <meta name="description" content="aplicación para el control de acceso a aseos">

        <link rel="stylesheet" href="css/style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>

    <body>

        <header>
            <h1 class="titulo">Control Alumnado</h1>
            <nav class="navtop">
			<div>
            <p>Bienvenido, <?=$_SESSION['name']?>! <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Salir</a></p>
			</div>
		</nav>
            <nav class="encabezado">
                <ul class="lista">
                    <li><a href="index.php" class="select">INICIO</a></li>
                    <li><a href="autorizacion.php">AUTORIZACIÓN</a></li>
                    <li><a href="control.php">CONTROL</a></li>
                    <li><a href="informacion.php">INFORMACIÓN</a></li>
                    <li><a href="contacto.php">CONTACTO</a></li>
                </ul>
            </nav>
        </header>


        <section class="container">
            <div class="container2">
                <a href="autorizacion.php"><input type="submit" value="AUTORIZACIÓN"></a>


                <a href="control.php"><input type="submit" value="CONTROL"></a>


                <div style="text-align:center;padding:1em 0;">
                    <h4><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/es/city/3117735"><span
                                style="color:gray;">Hora actual en</span><br />Madrid, España</a></h4> <iframe
                        src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=Europe%2FMadrid"
                        width="100%" height="90" frameborder="0" seamless></iframe>
                </div>


                <a href="informacion.php"><input type="submit" value="INFORMACIÓN"></a>
            </div>
        </section>

        <footer class="footer">
            <div class="post_Foter">
                <p>IES Lago Ligur</p>
                <p>2021 &copy; David Rayo</p>
            </div>
        </footer>


    </body>

    </html>