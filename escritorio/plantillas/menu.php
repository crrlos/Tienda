
<div id="menunavegacion">
    <ul id="menu">
        <li>
            <a href="/">Inicio</a>
        </li>

        <li>
            <a href="">Productos</a>
            <ul>
                <?php
                $categorias = \Base\CategoriasQuery::create()->find();
                foreach ($categorias as $categoria) {
                    ?>
                    <li>
                        <a href=""><?php echo $categoria->getNombre() ?></a>
                        <ul>
                            <?php
                           
                            $subcategorias = SubcategoriasQuery::create()->findByIdcategoria($categoria->getIdcategoria());
                            foreach ($subcategorias as $subcategoria) {
                                
                            
                            ?>
                            <li>
                                <a href="http://www.impuso2015.tk/productos/<?php echo str_replace(' ','-', $subcategoria->getNombre())?>/1">
                                    <?php echo $subcategoria->getNombre() ?>
                                </a>
                            </li>
                            <?php }//fin foreach subcategorias ?>

                        </ul>				
                    </li>
                <?php }//fin foreach categorias ?>
            </ul>
        </li>
        <li>

        
        <?php 
        if(!isset($_SESSION['usuario'])){//si no hay sesión de usuario iniciada
        ?>
        <li><a href="http://www.impuso2015.tk/carrito">Carrito</a></li>
       
        <?php }else{//sí hay sesión de usuario iniciada 
          
           $idusuario = UsuariosQuery::create()->findOneByNombreusuario($_SESSION['usuario'])->getIdusuario();
           $pedidos = PedidosQuery::create()->filterByIdcliente($idusuario)->filterByEstado('pendiente')->findOne();
           $totalarticulos = $pedidos != null?$pedidos->getDetallepedidoss()->count():0;
          
         ?>
        
       
        
        <li><a href="http://www.impuso2015.tk/carrito">Carrito(<?php echo  $totalarticulos ?>)</a></li>
        
       
        <?php } ?>
    </ul>
</div>