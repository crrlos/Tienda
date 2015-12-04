<?php
$usuario = UsuariosQuery::create()->findOneByNombreusuario($_SESSION['usuario']);

?>
<div id="detalle_pago">
<form action="/pago" method="post">
<table>
    <tr>
    <input type="hidden" name="oppago" value="1">
        <td>
            <b> direccion de envio:</b>
        </td>
        <td>
            <?php echo $usuario->getDireccion(); ?><br>
           
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
                <option value="3"> Pagadito</option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2">
    <center>Resumen del pedido:</center>
        </td>
    </tr>
    <tr>
        <th>artículo</th>
        <th>cantidad</th>
        <th>precio</th>
    </tr>
    <tr>
        <td><center>Jabón</center></td>
        <td><center>2</center></td>
        <td><center>$2.5</center></td> 
    </tr>
    <tr>
        <td>
            <input type="submit" value="Pagar">
        </td>
    </tr>
</table>
</form>
</div>