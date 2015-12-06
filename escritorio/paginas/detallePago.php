<?php
$usuario = UsuariosQuery::create()->findOneByNombreusuario($_SESSION['usuario']);
$pedido = PedidosQuery::create()->filterByEstado('pendiente')->filterByIdcliente($usuario->getIdusuario())->findOne();
$detallePedido;
if(!isset($pedido))
    echo 'nada';
else{
 $detallePedido = $pedido->getDetallepedidoss();
if($detallePedido->count() == 0)
{
    echo 'nada';
}else{
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
</table>
    <br>
    <br>
    <table>
    <tr>
        <td colspan="2">
    <center><b>Resumen del pedido:</b></center>
        </td>
    </tr>
    <tr>
        <th>artículo</th>
        <th>cantidad</th>
        <th>precio</th>
    </tr>
    <?php $total; 
    $total = 0;
    foreach ($detallePedido as $detalle) {?>
    <tr>
        <td><center><?= $detalle->getProductos()->getNombre() ?></center></td>
        <td><center><?= $detalle->getCantidad() ?></center></td>
        <td><center><?= '$'.$detalle->getPrecio() ?></center></td>
    </tr>
    <?php 
    $total += $detalle->getPrecio()*$detalle->getCantidad();
    }?>
    <tr>
        <th>Total</th>
        <th></th>
        <th><?= '$'.$total?></th>
    </tr>
    <tr>
        <td>
            <input type="submit" value="Pagar">
        </td>
    </tr>
</table>
</form>
</div>
<?php }}?>