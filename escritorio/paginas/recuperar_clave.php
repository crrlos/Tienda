<div id="recuperar">
    <?php
    if(isset($_GET['estado']))
    {
        if($_GET['estado'] == 0)
        {
          echo '<h5><font color = "red">el correo no existe</font></h5>';
        }else if($_GET['estado']==1)
        {
             echo '<h5><font color = "blue">correo enviado con éxito</font></h5>';
        }
    }
    ?>
<form action="http://www.impuso2015.tk/controladores/controladorUsuarios.php" method="get">
    <input type="hidden" name="opusuario" value="4">
    Ingrese su correo:<input type="text" name="correo" required="">
    <input type="submit">
</form>
</div>