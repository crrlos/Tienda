<div id="divproductos">
    <table id="tablaproductos">
        <?php
        $newRow = true;
        $cuenta = 0;
        foreach ($productosSubcategoria as $producto) {
          
            if ($newRow) {
                $newRow = !$newRow;
                ?>
                <tr>

                <?php } ?>
                <td>
                    <div id="producto">
                        <b><?= $producto->getNombre() ?></b><br>
                        <img src="http://www.impuso2015.tk/imagenes/moviles/mouse.png" width="100"><br>
                        <hr>
                        descripción del artículo
                        <br>
                        <b>Precio:</b><?= $producto->getPrecio()?>
                        <br>
                        <a href="http://www.impuso2015.tk/agregar/<?=$producto->getIdproducto()?>">
                            <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_cart_SM.gif" border="0" name="submit">
                        </a>
                    </div>
                </td>
            <?php 
            
            ++$cuenta;
            if($cuenta == 4){
                $cuenta = 0;
                $newRow = true;
                ?>
            </tr>
             <?php
            }
             
             
             } ?>
    </table>
</div>