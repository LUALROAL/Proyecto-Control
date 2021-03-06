<DOCTYPE html>
    <html lang="es">

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
                    <li><a href="inicio.php">INICIO</a></li>
                    <li><a href="autorizacion.php" class="select">AUTORIZACIÓN</a></li>
                    <li><a href="control.php">CONTROL</a></li>
                    <!-- <li><a href="informacion.php">INFORMACIÓN</a></li>
                    <li><a href="contacto.php">CONTACTO</a></li> -->
                </ul>
            </nav>
        </header>


        <section class="container">
            <div class="container2">
                <a href="Estudiantes.php?OrderBy=Grupo"><input type="submit" value="GRUPOS"></a>

                <a href="Estudiantes.php?OrderBy=Alfabetico"><input type="submit" value="ORDEN ALFABÉTICO"></a>

                <div style="text-align:center;padding:1em 0;">
                    <h4><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/es/city/3117735"><span
                                style="color:gray;">Hora actual en</span><br />Madrid, España</a></h4> <iframe
                        src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=Europe%2FMadrid"
                        width="100%" height="90" frameborder="0" seamless></iframe>
                </div>

                <div class="volver">
                    <a href="index.html"><img src="img/flamenco.svg" id="logoautorizacion" alt="volver"></a>
                </div>
                
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