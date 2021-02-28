<?php

require_once APP_PATH . 'Config.php';
require_once APP_PATH . 'Models.php';

function login($usuario, $contrasena)
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());

    }
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

function get_estudiantes($tipoOrden, $filter)
{

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());

    }
    if ($filter == "") {
        $sql = "select id,Nombre,Grupo,Tipo,Autorizado,Descripcion from estudiantes order by Nombre";
    } else {
        if ($tipoOrden == 'Alfabetico') {
            $sql = "select id,Nombre,Grupo,Tipo,Autorizado,Descripcion from estudiantes where Nombre like '%$filter%' order by Nombre";
        } else {
            $sql = "select id,Nombre,Grupo,Tipo,Autorizado,Descripcion from estudiantes where Grupo like '%$filter%' order by Nombre";
        }
    }

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
            $estudianteRow->Descripcion = $row["Descripcion"];
            array_push($estudiantes, $estudianteRow);
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $estudiantes;
}

function get_estudiante($id)
{

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());

    }
    $sql = "select id,Nombre,Grupo,Tipo,Autorizado,Descripcion from estudiantes where id=$id";

    $result = $conn->query($sql);

    $estudianteRow = new EstudianteModel();
    if ($result->num_rows == 1) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $estudianteRow->id = $row["id"];
            $estudianteRow->Nombre = $row["Nombre"];
            $estudianteRow->Grupo = $row["Grupo"];
            $estudianteRow->Tipo = $row["Tipo"];
            $estudianteRow->Autorizado = $row["Autorizado"];
            $estudianteRow->Descripcion = $row["Descripcion"];

        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $estudianteRow;
}

function hayPermisoActivadoAlumTipoC($id)
{

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());

    }
    $sql = "select count(id) as autorizados from estudiantes where Tipo='C' and Autorizado=1 and id<>$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $Nroautorizados = $row["autorizados"];

        }
    } else {
        return false;
    }
    $conn->close();
    return $Nroautorizados > 0;
}

function hay6PermisoActivados($id)
{

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());

    }
    $sql = "select count(id) as autorizados from estudiantes where  Autorizado=1 and id<>$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $Nroautorizados = $row["autorizados"];

        }
    } else {
        return false;
    }
    $conn->close();
    return $Nroautorizados >= 6;
}

function AutorizarEstudiante($id, $descripcion)
{

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());
    }
    $sql = "update estudiantes set Autorizado=1,Descripcion='$descripcion' where id=$id";
    if (mysqli_query($conn, $sql)) {
        $message = "Ok";
    } else {
        $message = "Error Actorizando al estudiante: $id  ->" . mysqli_error($conn);
    }
    $conn->close();
    echo $message;
    return $message;
}

function AgregarControl($id)
{

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO controlacceso ( idEstudiante, Fecha) VALUES( $id, current_timestamp);";
    if (mysqli_query($conn, $sql)) {
        $message = "Ok";
    } else {
        $message = "Error insertando control de acceso al estudiante: $id  ->" . mysqli_error($conn);
    }
    $conn->close();
    return $message;
}

function DenegarAutorizacionEstudiante($id)
{

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());
    }
    $sql = "update estudiantes set Autorizado=0,Descripcion='' where id=$id";
    if (mysqli_query($conn, $sql)) {
        $message = "Permiso Denegado";
    } else {
        $message = "Error Denegando Actorizacion al estudiante: $id  ->" . mysqli_error($conn);
    }
    $conn->close();
    return $message;
}

function AgotoTurnosDiarios($id)
{

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("No hay conexión: " . mysqli_connect_error());

    }
    $sql = "select count(id) as turnosDiarios from controlacceso where date(fecha) =current_date and idEstudiante=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $NroTurnosDiarios = $row["turnosDiarios"];

        }
    } else {
        return false;
    }
    $conn->close();
    return $NroTurnosDiarios >= 2;
}

function get_grupos()
{
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
