<?php
$usuario = UsuariosQuery::create()->findOneByNombreusuario($_SESSION['usuario']);

?>
<form>
<table>
    <tr>
        <td>
            <b> direccion de envio:</b>
        </td>
        <td>
            <?php echo $usuario->getDireccion(); ?><br>
            <?php echo $usuario->getMunicipios()->getNombre();?>,
            <?php echo $usuario->getDepartamentos()->getNombre()?>
        </td>
            
    </tr>
    <tr>
        <td>
            forma de pago:
        </td>
        <td>
            <select name="formadepago">
                <option value="1">Paypal</option>
                <option value="2">Tranferencia Bancaria</option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2">
    <center>Resumen del pedido:</center>
        </td>
    </tr>
    <tr>
        <td>
            <input type="submit" value="Pagar">
        </td>
    </tr>
</table>
</form>


