<?php
include './plantillas/header.php';

include './paginas/productos.php';

$opcion = isset($_GET['opcion'])?$_GET['opcion']:"";

switch ($opcion)
{
    case 'registro':
        include('./paginas/registro.php');
}







include './plantillas/footer.php';