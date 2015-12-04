

<?php
require_once 'paginas/header.php';

$opcion = isset($_GET['opcion'])?$_GET['opcion']:null;
switch ($opcion)
{
    case 'agregar':
        include('./paginas/agregarProducto.php');
        break;
    
}
require_once 'paginas/footer.php';
?>
