<?php
class Cliente{
    function iniciar(){
        $this->hola();
    }
    function hola(){
        echo 'hooa';
    }
    
}

$cliente = new Cliente();
$cliente->iniciar();
