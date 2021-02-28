<?php
define("APP_PATH", $_SERVER["DOCUMENT_ROOT"] . "/control/");
require_once APP_PATH . 'consultasDatabase.php';

if (session_id() === '' ? false : true) {
    header('Location:' . APP_PATH . 'index.html');
    exit;
}
session_start();
$tipoOrden = "";
if (isset($_GET["OrderBy"])) {
    $tipoOrden = $_GET["OrderBy"];

} else {

    die("Error No hay parametro: ");
}

if (isset($_GET["filter"])) {
    $filter = $_GET["filter"];

} else {

    $filter = "";
}

$estudiantes = get_estudiantes($tipoOrden, $filter);

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
                                        <li><a href="Inicio.php">INICIO</a></li>
                                        <li><a href="autorizacion.php" class="select">AUTORIZACIÓN</a></li>
                                        <li><a href="control.php">CONTROL</a></li>
                                        <!-- <li><a href="informacion.html">INFORMACIÓN</a></li>
                                        <li><a href="contacto.html">CONTACTO</a></li> -->
                                </ul>
                        </nav>
                </header>


                <div class="espaciado"></div>
<div class="contenedor_filtro" >

    <?php
if ($tipoOrden == 'Alfabetico') {
    echo "<h2>Autorización por orden Alfabetico</h2><br>";

} else {
    echo "<h2>Autorización por Grupo</h2>";
}

?>




<form class='example' action='estudiantes.php'>
    <input type='text'  name='OrderBy' value='<?php echo $tipoOrden; ?>' hidden>
    <input type='text' placeholder='Buscar..' name='filter'>
    <button type='submit'>Buscar<i class='fa fa-search'></i></button>
</form>

</div>


                <div class="contenedor_Listado1">


                <?php
if ($tipoOrden == 'Alfabetico') {

    for ($x = 65; $x <= 90; $x++) {
        echo "<h2><a href='' class='letra'>" . chr($x) . "</a></h2>";
        echo "<div>";
        foreach ($estudiantes as $i) {
            if (substr(strtoupper($i->Nombre), 0, 1) == chr($x)) {
                echo "<a href='SeleccionEstudiante.php?ID=$i->id'><li>" . $i->Nombre . "_" . $i->Grupo . "</li></a>";
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
                echo "<a href='SeleccionEstudiante.php?ID=$i->id'><li>" . $i->Nombre . "_" . $i->Grupo . "</li></a>";
            }
        }
        echo "</div><br><br>";
    }

}
?>
        </div>
        </body>

        </html>