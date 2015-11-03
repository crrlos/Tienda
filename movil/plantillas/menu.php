<div id='cssmenu'>
<ul>
   <li><a href='http://m.impuso2015.tk/'>Inicio</a></li>
   <li class='active has-sub'><a href=#>Productos</a>
      <ul>
          <?php
          $categorias = CategoriasQuery::create()->find();//obtención de las categorias
          foreach ($categorias as $categoria) {
              $subcategorias = $categoria->getSubCategoriass();
          
          
          ?>
          <li class='has-sub'><a href='#'><?php echo $categoria->getNombre(); ?></a>
              <?php foreach ($subcategorias as $subcategoria){
                  $nombreSubCategoria = $subcategoria->getNombre();
                  
               ?>
            <ul>
                <li><a href='http://m.impuso2015.tk/productos/<?php echo str_replace(' ','-',$nombreSubCategoria); ?>'>
                    
                    <?php echo $nombreSubCategoria;?></a></li>
               
            </ul>
              <?php }//cierre foreach subcategorias?>
         </li>
          <?php }//cierre foreach categorias ?>
        
      </ul>
   </li>
   <li><a href='#'>Carrito </a></li>
   
   <?php  if(!isset($_SESSION['usuario'])) {  ?>
   <li><a href='http://m.impuso2015.tk/registro'>Registrarse</a></li>
   
   <li><a href='http://m.impuso2015.tk/login'>Iniciar Sesión</a></li>
   <?php } else { ?>
   
   
   <li class="active has-sub"><a href="#">Usuario</a>
       <ul>
           <li><a href="#">CERRAR SESION</a></li>
       </ul>
   </li>
   
   <?php } ?>
   
  
</ul>
</div>