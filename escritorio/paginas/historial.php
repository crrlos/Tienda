<?php
$pedidos = PedidosQuery::create()->findByIdcliente($usuario->getIdusuario());
?>

<?php 
if($pedidos->count()== 0)
    echo '<h3><center>No tienes nada en tu historial</center></3>';
foreach ($pedidos as $pedido) { 
    $venta = VentasQuery::create()->findOneByIdpedido($pedido->getIdpedido());
    $detallePedido = $pedido->getDetallepedidoss();
    ?>
<div id="historial">
    <div id="fecha"><b>Fecha:</b> <?= date_format($venta->getFecha(), 'd-m-Y')?></div>
    <div id="estado"><b>Estado:</b> <?= $pedido->getEstado() ?></div>
    <table>
        <tr>
            <th>artículo</th>
            <th>cantidad</th>
            <th>precio</th>
        </tr>
       <?php foreach ($detallePedido as $detalle)  {
           $total = 0;
           $total += $detalle->getPrecio()*$detalle->getPrecio();
           ?> 
        <tr>
            <td><?= $detalle->getProductos()->getNombre()?></td>
            <td><center><?= $detalle->getCantidad()?></center></td>
            <td><?= '$'.$detalle->getPrecio()?></td>
        </tr>
      <?php }?>
        <tr>
            <th><center>Total</center></th>
    <th></th>
            <th><?= '$'.$total ?></th>
                
        </tr>
    </table>
<hr>    
</div>
<?php }?>