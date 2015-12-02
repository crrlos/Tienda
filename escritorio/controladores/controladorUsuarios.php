<?php

require_once 'config.php';

if (session_status() == PHP_SESSION_NONE)
    session_start();
if ($_POST)
    $opcion = isset($_POST['opusuario']) ? $_POST['opusuario'] : ''; //variable que contien la operacion a realizar
if ($_GET)
    $opcion = isset($_GET['opusuario']) ? $_GET['opusuario'] : '';
/*
 * 1-login
 * 2-registro
 * 3-actualizar
 */

switch ($opcion) {
    case 1:
        login();
        break;
    case 2:
        registrar();
        break;
    case 3:
        actualizar();
        break;
    case 4:
        recuperar();
        break;
    case 5:
       cambiarClave();
        break;
    
}

function login() {

    $usuario = UsuariosQuery::create()->findOneByNombreusuario($_POST['usuario']);

    if ($usuario != null) {
        if (sha1($_POST['clave'] )== $usuario->getClave()) {
            $_SESSION['usuario'] = $usuario->getNombreusuario();
            header("location:http://www.impuso2015.tk");
        }
    }
}

function registrar() {

    try {
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
    } catch (Exception $ex) {
        
    }
}

function actualizar() {
    try {
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
    } catch (Exception $ex) {
        
    }
}

function recuperar() {

    try {
        $usuario = UsuariosQuery::create()->findOneByEmail($_GET['correo']);
        if ($usuario != null) {
            $cadena = sha1($usuario->getClave() . $usuario->getNombreusuario());

            $hash = new Hash();
            $hash->setIdusuario($usuario->getIdusuario());
            $hash->setHash($cadena);
            $hash->save();
            
            
            $mail = "Para reestablecer tu contraseña ingresa en el siguiente enlace: "
                    . "http://www.impuso2015.tk/recuperacion/" . $cadena;
//Titulo
            $titulo = "Reestablecimiento de contraseña";
//cabecera
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
//dirección del remitente 
            $headers .= "From: Tienda";
//Enviamos el mensaje a tu_dirección_email 
            $bool = mail($_GET['correo'], $titulo, $mail, $headers);
            if ($bool) {
                echo "Mensaje enviado";
            } else {
                echo "Mensaje no enviado";
            }
            header("location:http://www.impuso2015.tk/forgot/correcto");
        }
        else
        header("location:http://www.impuso2015.tk/forgot/error");
    } catch (Exception $ex) {
        
    }
    
    
}
function cambiarClave(){
    if(isset($_POST['hash']))
        {
          $usuario = HashQuery::create()->findOneByHash($_POST['hash']);
          if(isset($usuario))
          {
              $user = UsuariosQuery::create()->findOneByIdusuario($usuario->getIdusuario());
              $user->setClave(sha1($_POST['clave']));
              $user->save();
              $usuario->delete();
          }
        
            
        }
    }
