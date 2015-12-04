<div id='carrito'>
   
    <form action="http://www.impuso2015.tk/opcarrito" method="post">
    <table>
        
        <tr>
            <th>Artículo</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
            <th>X</th>
        </tr>
        <?php
        foreach ($detalle_pedido as $detalle) {
                $producto = ProductosQuery::create()->findOneByIdproducto($detalle->getIdproducto());
                $descuento = 1 - (DescuentosQuery::create()->findOneByIddescuento($producto->getIddescuento())->getValor()/100);
                $precio_producto = $producto->getPrecio() * $descuento;
                if ($precio_producto != $detalle->getPrecio()) {
                    $detalle->setPrecio($precio_producto);
                    $detalle->save();
                    
                }
                
        ?>
       
        <tr>
            <td>
                
                <?php echo $producto->getNombre() ?>
            </td>
            <td>
                <input type="text" name="cantidad[]" style="width: 25px;text-align: center"value="<?php echo $detalle->getCantidad()?>">
                
            </td>
            <td>
                <?php echo ' $'.$precio_producto?>
            </td>
            <td>
                <?php echo ' $'.$precio_producto * $detalle->getCantidad()?>
            </td>
            <td>
                <input type="checkbox" name="seleccion[]" value="<?php echo $detalle->getIddetallepedido() ?>">
            </td>
        </tr>
        <?php } ?>
        
    </table>
        <center>
                <input type="submit" name="opcion" value="Actualizar">
                 <input type="submit" name="opcion" value="Eliminar">
                 <input type="button" onclick="location='http://www.impuso2015.tk/pago'" value="Ir a pagar">
        </center>
    </form>
   
</div>

