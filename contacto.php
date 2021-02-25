<DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="author" content="David">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta nane="keyboards" content="control">
        <meta name="description" content="aplicación para el control de acceso a aseos">

        <title>Contacto</title>

        <link rel="stylesheet" href="css/style.css">
        <link rel="shortcut icon" href="img/favicon.png">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>

    <body>

        <header>
            <h1 class="titulo">Control Alumnado</h1>
            <nav class="encabezado">
                <ul class="lista">
                    <li><a href="index.html" >INICIO</a></li>
                    <li><a href="autorizacion.php">AUTORIZACIÓN</a></li>
                    <li><a href="control.php">CONTROL</a></li>
                    <li><a href="informacion.php">INFORMACIÓN</a></li>
                    <li><a href="contacto.php" class="select">CONTACTO</a></li>
                </ul>
            </nav>
        </header>


        <section class="container">
            <form action="">
                <h2 class="titulo_Contacto">CONTACTO</h2>
                <input type="text" name="Name" placeholder="Nombre" class="input_contacto">
                <input type="text" name="Email" placeholder="Email" class="input_contacto">
                <textarea name="mensaje" id="" cols="30" rows="10" placeholder="Escribe tu mensaje "></textarea>
                <input type="button" value="ENVIAR" id="boton" class="input_contacto">
                
            <div class="volver center">
                <a href="index.html"><img src="img/flamenco.svg" id="logocontrol" alt="volver"></a>
            </div> 
            </form>

        </section>

        <footer class="footer">
            <div class="post_Foter">
                <p>IES Lago Ligur</p>
                <p>2021 &copy; David Rayo</p>
            </div>
        </footer>

    </body>

    </html>