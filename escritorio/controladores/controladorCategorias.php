<?php
require_once 'config.php';
$opcion = isset($_POST['opcategoria'])?$_POST['opcategoria']:null;

switch ($opcion)
{
    case 1:
        mostrarSubcategorias();
        break;
}

function mostrarSubcategorias(){
    $subcategorias  = SubcategoriasQuery::create()->findByIdcategoria($_POST['categoria']);
    foreach ($subcategorias as $subcategoria) {
        echo "<option value='".$subcategoria->getIdsubcategoria()."'>".$subcategoria->getNombre()."</option>";
    }
    
}