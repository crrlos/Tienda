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
<div id="login">
    <table>
        <form action ="/controladores/controladorUsuarios.php" method="post">
            <input type="hidden" name="opusuario" value="<?= $nombreUsuario!=null?"3":2?>">
            <tr>
                <td>Usuario:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="nombreusuario" value="<?= $usuario != null?$usuario->getNombreusuario():'' ?>">
                </td>
            </tr>
            <tr>
                <td>Nombres:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="nombres" value="<?= $usuario != null?$usuario->getNombres():'' ?>">
                </td>
            </tr>
            <tr>
                <td>Apellidos:</td>
            </tr>
            <tr>
                <td><input type="text" name="apellidos" value="<?= $usuario != null?$usuario->getApellidos():'' ?>"></td>
            </tr>
            <tr>
                <td>Teléfono:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="telefono" value="<?= $usuario != null?$usuario->getTelefono():'' ?>">
                </td>
            </tr>
            <tr>
                <td>Email:</td>
            </tr>
            <tr>
                <td><input type="text" name="email" value="<?= $usuario != null?$usuario->getEmail():'' ?>"></td>
            </tr>
            <tr>
                <td>Direccion:</td>
            </tr>
            
            <tr>
                <td>
                    <textarea rows="2" cols="40" name="direccion" value="<?= $usuario != null?$usuario->getDireccion():'' ?>">
                        
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
                    <input type="password" name="clave">
                </td>
            </tr>
            <tr>
                <td>
                    Repetir Contraseña:
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="confirmacionClave">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="<?= $nombreUsuario!= null?"Actualizar":"Registrarse"?>"></td>
            </tr>

        </form>
    </table>
   
</div>