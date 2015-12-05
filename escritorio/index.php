<?php

session_start();
//archivos del modelo
require_once '../modelo/vendor/autoload.php';
require_once '../modelo/generated-conf/config.php';
////////////////////////////////////////////////

require_once './plantillas/Mobile.php';

include("./plantillas/header.php");
//redireccion a web movil
$detect = new Mobile_Detect();
if ($detect->isMobile())
    header("Location: http://m.impuso2015.tk");
///////////////////////////////////////////////


$opcion = isset($_GET['opcion']) ? $_GET['opcion'] : "";

switch ($opcion) {
    case 'productos':
        include('./controladores/controladorProductos.php');
        break;
    case 'registro':
        include('./paginas/usuario.php');
        break;
    case 'login':
        include('./paginas/login.php');
        break;
    case 'logout':
        include('./paginas/cerrarSesion.php');
        break;
    case 'carrito':
        include('./controladores/controladorPedidos.php');
        break;
    case 'pago':
        include('./controladores/controladorPago.php');
        break;
    case 'actualizar':
        include('./paginas/usuario.php');
        break;
    case 'recuperar':
        include('./paginas/recuperar_clave.php');
        break;
    case 'cambiar':
        include('./paginas/cambio_clave.php');
        break;
    case 'detalle':
        break;
    case 'notfound':
         include('./paginas/error.php');
        break;
    default:
      
}

require_once './plantillas/footer.php';
