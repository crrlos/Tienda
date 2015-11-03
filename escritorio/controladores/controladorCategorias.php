<?php

$getCategorias =  CategoriasQuery::create()->find();

foreach ($getCategorias as $value) {
    $getSubCategorias = $value->getSubCategoriass();
    foreach ($getSubCategorias as $categoria) {
        echo $categoria->getNombreSubcategoria();
    }
}