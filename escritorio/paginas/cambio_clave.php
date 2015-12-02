<form action="http://www.impuso2015.tk/controladores/controladorUsuarios.php" method="post">
    <table>
        <tr>
            <td>
                Ingrese contraseña nueva:
            </td>
            <td>
                <input type="text" name="clave">
                <input type="hidden" name="hash" value="<?= $_GET['hash']?>">
                <input type="hidden" name="opusuario" value="5">
                       
            </td>
        </tr>
        <tr>
            <td>
                Repetir contraseña:
            </td>
            <td>
                <input type="text" name="clave2">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit">
            </td>
        </tr>
            
    </table>
    
   
   
    
</form>
