<?php
define("APP_PATH", $_SERVER["DOCUMENT_ROOT"] . "/control/");
require_once APP_PATH . 'consultasDatabase.php';

if (session_id() === '' ? false : true) {
    header('Location:' . APP_PATH . 'index.html');
    exit;
}
session_start();
$tipoOrden = $_GET["OrderBy"];
$estudiantes = get_estudiantes();

?>


<!DOCTYPE html>
        <html lang="en">

        <head>
                <meta charset="UTF-8">
                <meta name="author" content="David">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta nane="keyboards" content="control">
                <meta name="description" content="aplicación para el control de acceso a aseos">

                <title>Autorización</title>

                <link rel="stylesheet" href="css/style.css">
                <link rel="shortcut icon" href="img/flavicon.png">
                <link rel="preconnect" href="https://fonts.gstatic.com">
                <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        </head>

        <body>

                <header>
                        <h1 class="titulo">Control Alumnado</h1>
                        <nav class="encabezado">
                                <ul class="lista">
                                        <li><a href="index.html">INICIO</a></li>
                                        <li><a href="autorizacion.html" class="select">AUTORIZACIÓN</a></li>
                                        <li><a href="control.html">CONTROL</a></li>
                                        <li><a href="informacion.html">INFORMACIÓN</a></li>
                                        <li><a href="contacto.html">CONTACTO</a></li>
                                </ul>
                        </nav>
                </header>


                <div class="espaciado"></div>
                <div class="contenedor_Listado1">


<?php
if ($tipoOrden == 'Alfabetico') {

    for ($x = 65; $x <= 90; $x++) {
        echo "<h2><a href='' class='letra'>" . chr($x) . "</a></h2>";
        echo "<div>";
        foreach ($estudiantes as $i) {
            if (substr(strtoupper($i->Nombre), 0, 1) == chr($x)) {
                echo "<a href=''><li>" . $i->Nombre . "_" . $i->Grupo . "</li></a>";
            }
        }
        echo "</div><br><br>";
    }
    # code...
} else {
    $grupos = get_grupos();
    foreach ($grupos as $g) {
        echo "<h2><a href='' class='letra'>" . $g . "</a></h2>";
        echo "<div>";
        foreach ($estudiantes as $i) {
            if ($i->Grupo == $g) {
                echo "<a href=''><li>" . $i->Nombre . "_" . $i->Grupo . "</li></a>";
            }
        }
        echo "</div><br><br>";
    }

}
?>
        </div>
        </body>

        </html>