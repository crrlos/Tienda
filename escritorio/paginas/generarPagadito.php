 <form action="controladores/cobro.php" method="post">
     
       

       <?php
       $i = 1;
       foreach ($detallePedido as $detalle) {
           $producto = ProductosQuery::create()->findOneByIdproducto($detalle->getIdproducto());
           
       ?>
        <input type="hidden" name="item_name_<?=$i?>" value="<?=$producto->getNombre()?>">
        <input type="hidden" name="amount_<?=$i?>" value="<?=$producto->getPrecio()?>">
        <input type="hidden" name="quantity_<?=$i?>" value="<?=$detalle->getCantidad()?>">
      
       
       <?php 
       ++$i;
       }?>
       
        <center>
    <h2> Procesando su pedido...<br>
        <hr>
     <input type="image" src="/../imagenes/loading.gif"  id="button1">
</center>
    </form>



<script type="text/javascript">
        function clickButton() {

            document.getElementById('button1').click()
        }
    clickButton();
    </script>