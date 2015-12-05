<div id="titulo"><?=$producto->getNombre()?></div>


<div id="imagen_detalle">
    <img id="zoom_01"  src="http://www.impuso2015.tk/imagenes/<?=$producto->getIdproducto()?>/small.jpg" data-zoom-image="http://www.impuso2015.tk/imagenes/<?=$producto->getIdproducto()?>/large.jpg" height="200">
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



