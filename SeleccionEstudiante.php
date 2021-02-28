<?php
define("APP_PATH", $_SERVER["DOCUMENT_ROOT"] . "/control/");
require_once APP_PATH . 'consultasDatabase.php';

if (session_id() === '' ? false : true) {
    header('Location:' . APP_PATH . 'index.html');
    exit;
}
session_start();

$permisoActivado = false;
$descripcion="";
if (isset($_POST["ID"])) {
    
    $idEstudiante = $_POST["ID"];
    $mensaje=$_POST["Mensaje"];
    $descripcion=$_POST["descripcion"];
    if ($descripcion!="") {
        $men=AutorizarEstudiante($idEstudiante,$descripcion);
        if ($men=='Ok') {
            $mensaje="Permiso Activado";
        }else{
            $mensaje=$men;
        }
    }
    $estudiante = get_estudiante($idEstudiante);
    
} else {

    if (isset($_GET["ID"])) {
        $idEstudiante = $_GET["ID"];

    } else {

        die("Error No hay parametro: ");
    }

    $estudiante = get_estudiante($idEstudiante);

    switch ($estudiante->Tipo) {
        case 'N':
            $permisoActivado = true;
            break;
        case 'C':
            $HayPermisosActivos = hayPermisoActivadoAlumTipoC($idEstudiante);

            if ($HayPermisosActivos) {
                $mensaje = "Permiso Temporalmente No Disponible";
            } else {
                $AgotoTurnosD = AgotoTurnosDiarios($idEstudiante);
                if ($AgotoTurnosD) {
                    $mensaje = "Permiso Denegado";
                } else {
                    $hay6Permisos = hay6PermisoActivados($idEstudiante);
                    if ($hay6Permisos) {
                        $mensaje = "Permiso Temporalmente No Disponible";
                    } else {
                        $permisoActivado = true;
                    }
                }

            }
            break;
        case 'A':
            $AgotoTurnosD = AgotoTurnosDiarios($idEstudiante);
            if ($AgotoTurnosD) {
                $mensaje = "Permiso Denegado";
            } else {
                $hay6Permisos = hay6PermisoActivados($idEstudiante);
                if ($hay6Permisos) {
                    $mensaje = "Permiso Temporalmente No Disponible";
                } else {
                    $permisoActivado = true;
                }
            }
            break;
        default:
            die("Error de tipo ");
            break;
    }
    if ($permisoActivado) {       
        $mensaje = "Permiso se puede Activar";
        
    } else {
        $me = DenegarAutorizacionEstudiante($idEstudiante);
        if ($me == "Ok") {
            $estudiante->Autorizado = false;
        }
    }

}

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
                        <h1 class="titulo">Autorización</h1>
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


                <table  class="tableDetalle">
                    <tr>
                        <th>Estudiante:</th>
                        <td><?php echo $estudiante->Nombre; ?></td>
                    </tr>
                    <tr>
                        <th>Tipo:</th>
                        <td><?php echo $estudiante->Tipo; ?></td>
                    </tr>
                    <tr>
                        <th>Grupo:</th>

                        <td><?php echo $estudiante->Grupo; ?></td>
                    </tr>
                    <tr>
                        <th>Autorizado:</th>
                        <td><?php echo $estudiante->Autorizado ? "Si" : "No"; ?></td>

                    </tr>
                    <tr>
                        <th>Estado:</th>
                        <td><?php echo $mensaje; ?></td>

                    </tr>
                    
                    <tr>
                        <th>Descripción:</th>
                        <td>
                            <?php
                            if ($permisoActivado ) {?>
                            <form action="SeleccionEstudiante.php" method="post">
                                <input type='text'  name='ID' value='<?php echo $idEstudiante; ?>' hidden>
                                <input type='text'  name='Mensaje' value='<?php echo $mensaje; ?>' hidden>
                                <textarea rows="6" cols="40" name="descripcion"   ></textarea>
                                <br>
                                <button type='submit'>Enviar</i></button>
                            </form>
                            <?php }else if($estudiante->Descripcion!=""){
                            echo $estudiante->Descripcion;
                        }?>
                        </td>
                    </tr>
                
                </table>






        </body>

        </html>