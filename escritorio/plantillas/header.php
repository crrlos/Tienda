<!doctype html>
<html lang=''>
    <head>

        <link rel="alternate" media="only screen and (max-width: 640px)"href="http://m.impuso2015.tk" >

        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="http://www.impuso2015.tk/css/style.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="http://www.impuso2015.tk/css/responsive_menu_style.css" media="screen" />
        <script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src=" https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script  src="http://www.impuso2015.tk/scripts/responsive_menu_script.js"></script>
        <script   src="http://www.impuso2015.tk/scripts/scripts.js"></script>
         <script src="http://www.impuso2015.tk/scripts/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="http://www.impuso2015.tk/scripts/jquery.elevatezoom.js" type="text/javascript"></script>
         


        <title>Tienda</title>

    </head>

    <div id="wrapper">
        <header>
            <div id="banner">
                <div id="buscar">
                    <form action="http://www.impuso2015.tk/buscar">
                        <table>
                            <tr>
                                <td>
                                    <input type="text" placeholder="Buscar...">
                                </td>
                                <td>
                                    <button type="submit">
                                        <img src="http://www.impuso2015.tk/imagenes/lupa.jpg" width="10">
                                    </button>
                                </td>
                            </tr>
                        </table>


                    </form>
                </div>
                <div id="acceso">
                    <div id="content">

                        <?php
                        if (!isset($_SESSION['usuario'])) {
                            require_once __DIR__ . '/menu_login.php';
                        } else
                            require_once __DIR__ . '/menu_usuario.php';
                        ?>
                    </div>
                </div>
            </div>
        </header>
        <nav id="nav"> 

            <?php include("menu.php"); ?>

        </nav>
        <body>
            


