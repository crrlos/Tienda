<div id="divproductos">
    <table id="tablaproductos">
        <?php
        $newRow = true;
        $cuenta = 0;
        $limite_superior = $pagina * 8;
        $limite_inferior = $limite_superior -7;
        $num_articulo = 1;
        foreach ($productosSubcategoria as $producto) {
                if($num_articulo >= $limite_inferior && $num_articulo <= $limite_superior){
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
                        <b>Precio:</b><?= $producto->getPrecio() ?>
                        <br>
                        <a href="http://www.impuso2015.tk/detalles/producto/<?= $producto->getIdproducto() ?>">detalles</a>
                        <br>
                        <br>
                        <a href="http://www.impuso2015.tk/agregar/<?= $producto->getIdproducto() ?>">
                            <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_cart_SM.gif" border="0" name="submit">
                        </a>
                    </div>
                </td>
                <?php
                ++$cuenta;
                if ($cuenta == 4) {
                    $cuenta = 0;
                    $newRow = true;
                    ?>
                </tr>
                <?php
            }
                }
                $num_articulo++;
        }
        ?>
    </table>
</div>
<div id="paginacion">
    <?php
    $numeros = "";
    for( $i = 1; $i <= ceil($total / 8);++$i)
    {
       
        $numeros.= "<a href='http://www.impuso2015.tk/productos/".str_replace('-',' ', $_GET['subcategoria'])."/$i'><color = 'red'>".$i."\t</color></a>";
    }
    echo $numeros;
    ?>
</div>