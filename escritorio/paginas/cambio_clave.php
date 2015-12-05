
<div id="cambio_clave">
    
    <?php
if($_GET['estado'] == 2)
    echo '<h5><font color = "red">el código de reestablecimiento es inválido, solicite uno nuevo.</font></h5>';
else if($_GET['estado'] == 3)
    echo '<h5><font color = "blue">contraseña cambiada con éxito</font></h5>';
?>
    
<form action="http://www.impuso2015.tk/controladores/controladorUsuarios.php" method="post" onsubmit="return validar_cambio()">
    <table>
        <tr>
            <td>
                Ingrese contraseña nueva:
            </td>
            <td>
                <input type="password" name="clave" id="clave" required="">
                <input type="hidden" name="hash" value="<?= $_GET['hash']?>">
                <input type="hidden" name="opusuario" value="5">
                       
            </td>
        </tr>
        <tr>
            <td>
                Repetir contraseña:
            </td>
            <td>
                <input type="password" name="clave2" id="clave2" required="">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit">
            </td>
        </tr>
            
    </table>
    
   
   
    
</form>
</div>