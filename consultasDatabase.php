<?php

require_once APP_PATH . 'Config.php';
require_once APP_PATH . 'Models.php';

function login($usuario, $contrasena)
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());

    }
    echo "hola";
    $query = mysqli_query($conn, "SELECT * FROM login WHERE usuario = '" . $usuario . "' and password = '" . $contrasena . "'");
    $nr = mysqli_num_rows($query);
    $conn->close();
    if ($nr > 0) {
        return $usuario;

    } else if ($nr == 0) {
        return "";
        header("Location: index.html");
        echo "No ingreso";
    }
    
}

function get_estudiantes()
{

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());

    }

    $sql = "select id,Nombre,Grupo,Tipo,Autorizado from estudiantes order by Nombre";
    $result = $conn->query($sql);
    $estudiantes = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $estudianteRow = new EstudianteModel();
            $estudianteRow->id = $row["id"];
            $estudianteRow->Nombre = $row["Nombre"];
            $estudianteRow->Grupo = $row["Grupo"];
            $estudianteRow->Tipo = $row["Tipo"];
            $estudianteRow->Autorizado = $row["Autorizado"];
            array_push($estudiantes, $estudianteRow);
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $estudiantes;
}

function get_grupos(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());

    }

    $sql = "select distinct Grupo from estudiantes order by 1";
    $result = $conn->query($sql);
    $grupos = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

           
            array_push($grupos, $row["Grupo"]);
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $grupos;

}
