<?php
require_once 'config.php';

$opcion = isset($_GET['opproducto'])?$_GET['opproducto']:'';

switch($opcion){
  default:
        mostrarProductos();
        break;
}

function mostrarProductos(){
  $productosSubcategoria = SubcategoriasQuery::create()->findOneByNombre(str_replace('-',' ', $_GET['subcategoria']))->getProductoss();
   
   require_once __DIR__.'/../paginas/productos.php';
    
}