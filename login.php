

<?php
    session_start();
    define ("APP_PATH", $_SERVER ["DOCUMENT_ROOT"]. "/control/");
    require_once APP_PATH.'Config.php';
    $conn = mysqli_connect (DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) 
    {
        die("No hay conexión: " .mysqli_connect_error ());
    }

    $nombre = $_POST ["txtusuario"];
    $pass   = $_POST ["txtpassword"];

    $query = mysqli_query ($conn, "SELECT * FROM login WHERE usuario = '".$nombre."' and password = '".$pass."'");
    $nr = mysqli_num_rows($query);


    if($nr > 0)
    {
        echo '<br>login';
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $nombre;
        $_SESSION['id'] = $nombre;
        header('Location: inicio.php');
    }
    else if ($nr == 0)
    {
        header ("Location: index.php");
        echo "No ingreso";
    }

?>