<?php
require_once 'config.php';

$opcion = isset($_GET['opproducto'])?$_GET['opproducto']:'';

switch($opcion){
    case 1:
        detalleProducto();
        break;
  default:
        mostrarProductos();
        break;
}

function mostrarProductos(){
  $productosSubcategoria = SubcategoriasQuery::create()->findOneByNombre(str_replace('-',' ', $_GET['subcategoria']))->getProductoss();
  $total = $productosSubcategoria->count();
  $pagina = $_GET['pagina'];
   require_once __DIR__.'/../paginas/productos.php';
    
}

function detalleProducto(){
    $producto = ProductosQuery::create()->findOneByIdproducto($_GET['idproducto']);
    $descuento = 1 - (DescuentosQuery::create()->findOneByIddescuento($producto->getIddescuento())->getValor()/100);
    if(isset($producto))
    {
        require_once __DIR__.'/../plantillas/header.php';
        require_once __DIR__.'/../paginas/producto_detalle.php';
        require_once __DIR__.'/../plantillas/footer.php';
    }
}