<?php

require_once 'config.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();

$opcion = isset($_POST['opusuario'])?$_POST['opusuario']:'';//variable que contien la operacion a realizar
/*
 * 1-login
 * 2-registro
 * 3-actualizar
 */

switch ($opcion)
{
    case 1:
    login();
        break;
    case 2:
        registrar();
        break;
    case 3:
        actualizar();
        break;
    
}

    
    
   
    



function login(){
    
    $usuario = UsuariosQuery::create()->findOneByNombreusuario($_POST['usuario']);
    
    if($usuario != null)
    {   
        if($_POST['clave'] == $usuario->getClave())
        {
            $_SESSION['usuario'] = $usuario->getNombreusuario();
            header("location:http://www.impuso2015.tk");
        }
    }
    
    
}
function registrar(){
    
    try{
    $usuario = new Usuarios();
    $usuario->setNombreusuario($_POST['nombreusuario']);
    $usuario->setNombres($_POST['nombres']);
    $usuario->setApellidos($_POST['apellidos']);
    $usuario->setTelefono($_POST['telefono']);
    $usuario->setEmail($_POST['email']);
    $usuario->setDireccion($_POST['direccion']);
    $usuario->setIddepartamento($_POST['departamento']);
    $usuario->setIdmunicipio($_POST['municipio']);
    $usuario->setClave($_POST['clave']);
    $usuario->setIdrol(2);
    $usuario->setFecharegistro(date("Y-m-d"));
    $usuario->save();
    $_SESSION['usuario'] = $usuario->getNombreusuario();
    
    }catch(Exception $ex){
       
    }
    
}

function actualizar(){
    try{
    $usuario = UsuariosQuery::create()->findOneByIdusuario($_POST['idusuario']);
    $usuario->setNombreusuario($_POST['nombreusuario']);
    $usuario->setNombres($_POST['nombres']);
    $usuario->setApellidos($_POST['apellidos']);
    $usuario->setTelefono($_POST['telefono']);
    $usuario->setEmail($_POST['email']);
    $usuario->setDireccion($_POST['direccion']);
    $usuario->setIddepartamento($_POST['departamento']);
    $usuario->setIdmunicipio($_POST['municipio']);
    $usuario->setClave($_POST['clave']);
    $usuario->save();
    }catch(Exception $ex){
       
    }
    
}