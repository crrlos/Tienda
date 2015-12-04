<div id="titulo"><?=$producto->getNombre()?></div>


<div id="imagen_detalle">
    <img src="http://ll-us-i5.wal.co/dfw/4ff9c6c9-2ac9/k2-_ed8b8f8d-e696-4a96-8ce9-d78246f10ed1.v1.jpg-bc204bdaebb10e709a997a8bb4518156dfa6e3ed-optim-450x450.jpg" width="200">
</div>
<div id="detalle_producto">
    <br>
    <b>Detalles:</b>
    <br>
    <?= $producto->getDetalle() ?>
    <br>
    <br>
    <b>Precio: </b>$<?= $producto->getPrecio() * $descuento ?>
    <br><br>
   
     <a href="http://www.impuso2015.tk/agregar/<?= $producto->getIdproducto() ?>">
        <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_cart_SM.gif" border="0" name="submit"></a>
</div>
<hr>
<div id="redes">
    <table>
        <tr>
            <td>
                <div class="fb-share-button" data-href="http://www.impuso2015.tk/detalles/producto/<?= $producto->getIdproducto() ?>" data-layout="button">
    </div>
            </td>
            <td style="padding-top: 5px;">
                <a href="https://twitter.com/share" class="twitter-share-button"{count} data-url="http://www.impuso2015.tk/detalles/producto/<?= $producto->getIdproducto() ?>" data-text="Mira este artículo">Tweet</a>
            </td>
            <td>
                <div class="g-plus" data-action="share" data-annotation="none" data-height="24" data-href="http://www.impuso2015.tk/detalles/producto/<?= $producto->getIdproducto() ?>"></div>
            </td>
        </tr>
        </table>
</div>



