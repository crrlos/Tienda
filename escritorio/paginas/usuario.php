<?php 
$nombreUsuario = isset($_SESSION['usuario'])?$_SESSION['usuario']:null;
$usuario = UsuariosQuery::create()->findOneByNombreusuario($nombreUsuario);
?>
<div id="mensaje_actualizacion">
    <?php
    if(isset($_GET['estado']))
    {
        if($_GET['estado'] == 'correcto')
            echo 'actualización de datos correcta';
    }
    ?>
</div>
<div id="registro_usuario">
    <table>
        <form action ="/controladores/controladorUsuarios.php" method="POST" onsubmit="return validar()" name="form1">
            <input type="hidden" name="opusuario" value="<?= $nombreUsuario!=null?"3":2?>">
            <input type="hidden" name="ok_usuario" id="ok_usuario" value="">
            <input type="hidden" name="ok_email" id="ok_email">
            <tr>
                <td>Usuario:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" required="" id="nombreusuario" name="nombreusuario" value="<?= $usuario != null?$usuario->getNombreusuario():'' ?>">
                    <div id="estado_usuario"></div>
                  </td>
            </tr>
            <tr>
                <td>Nombres:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="nombres" required="" value="<?= $usuario != null?$usuario->getNombres():'' ?>">
                </td>
            </tr>
            <tr>
                <td>Apellidos:</td>
            </tr>
            <tr>
                <td><input type="text" name="apellidos" required="" value="<?= $usuario != null?$usuario->getApellidos():'' ?>"></td>
            </tr>
            <tr>
                <td>Teléfono:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="telefono" required="" value="<?= $usuario != null?$usuario->getTelefono():'' ?>">
                </td>
            </tr>
            <tr>
                <td>Email:</td>
            </tr>
            <tr>
                <td>
                    <input id="email" type="text" name="email" required="" value="<?= $usuario != null?$usuario->getEmail():'' ?>">
                    <div id="estado_email"></div>
                </td>
                
            </tr>
            <tr>
                <td>Direccion:</td>
            </tr>
            
            <tr>
                <td>
                    <textarea rows="2" cols="40" name="direccion" value="<?= $usuario != null?$usuario->getDireccion():''?>">
                        
                    </textarea>
                    
                </td>
            </tr>
            <tr>
                <td>
                    Contraseña:
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="clave" required="">
                </td>
            </tr>
            <tr>
                <td>
                    Repetir Contraseña:
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="confirmacionClave" required="">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="<?= $nombreUsuario!= null?"Actualizar":"Registrarse"?>"></td>
            </tr>

        </form>
    </table>
   
</div>