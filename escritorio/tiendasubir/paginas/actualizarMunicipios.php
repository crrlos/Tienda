<?php
require_once '../../modelo/vendor/autoload.php';
require '../../modelo/generated-conf/config.php';

$municipios = MunicipiosQuery::create()->findByIddepartamento($_GET['id']);






foreach ($municipios as $value) {
    $idmunicipio = $value->getIdmunicipio();
    $nombreMunicipio = $value->getNombre();
    echo "<option value='$idmunicipio' >$nombreMunicipio</option>";
}