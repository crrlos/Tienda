<?php
if($_POST)
{
    $usuario = $_POST['usuario'];
    if($usuario == "carlos")
    {
        echo '1';
    }else
        echo '0';
}
