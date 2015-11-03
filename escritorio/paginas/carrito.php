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
        foreach ($productos as $producto) {
                $articulo = ProductosQuery::create()->findOneByIdproducto($producto->getIdproducto());
                if ($articulo->getPrecio() != $producto->getPrecio()) {
                    $producto->setPrecio($articulo->getPrecio());
                    $producto->save();
                   
                }
        ?>
        <tr>
            <td>
                
                <?php echo $articulo->getNombre() ?>
            </td>
            <td>
                <input type="text" name="cantidad[]" style="width: 25px;text-align: center"value="<?php echo $producto->getCantidad()?>">
                
            </td>
            <td>
                <?php echo ' $'.$articulo->getPrecio()?>
            </td>
            <td>
                <?php echo ' $'.$articulo->getPrecio()*$producto->getCantidad()?>
            </td>
            <td>
                <input type="checkbox" name="seleccion[]" value="<?php echo $producto->getIddetallepedido() ?>">
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

