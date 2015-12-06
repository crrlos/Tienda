<?php 
require_once __DIR__.'/../../controladores/config.php';
$categorias = CategoriasQuery::create()->find();

$descuentos = DescuentosQuery::create()->find();
?>
<form action="http://www.impuso2015.tk/controladores/controladorProductos.php" method="POST" enctype="multipart/form-data">
    <table>
        <input type="hidden" value="2" name="opproducto">
        <tr>
            <td>
                Código de producto:
            </td>
            <td>
                <input type="text" name="codigo">
            </td>
                
        </tr>
        <tr>
            <td>
                Nombre:
            </td>
            <td>
                <input type="text" name="nombre">
            </td>
                
        </tr>
        <tr>
            <td>
                Detalle:
            </td>
            <td>
                <input type="text" name="detalle">
            </td>
                
        </tr>
        <tr>
            <td>
                Descripción:
            </td>
            <td>
                <input type="text" name="descripcion">
            </td>
                
        </tr>
        <tr>
            <td>
                Precio:
            </td>
            <td>
                <input type="text" name="precio">
            </td>
                
        </tr>
        <tr>
            <td>
                Cantidad:
            </td>
            <td>
                <input type="text" name="cantidad">
            </td>
                
        </tr>
        <tr>
            <td>
               Categoría:
            </td>
            <td>
                <select onchange="cargar_subcategorias();" id="categorias">
                    <option value="0">----------------</option>
                    <?php  
                    foreach ($categorias as $categoria){
                    ?>
                    <option value="<?= $categoria->getIdcategoria()?>"><?= $categoria->getNombre()?></option>
                    <?php }?>
                </select>
            </td>
                
        </tr>
        <tr>
            <td>
               SubCategoria:
            </td>
            <td>
                <select id="subcategorias" name="subcategoria">
                    <option value="1">subcategoria</option>
                </select>
            </td>
                
        </tr>
        <tr>
            <td>
                Descuento:
            </td>
            <td>
               <select name="descuento">
                      <?php  
                    foreach ($descuentos as $descuento){
                    ?>
                   <option value="<?= $descuento->getIddescuento()?>"><?= $descuento->getValor()?>%</option>
                    <?php }?>
                </select>
            </td>
                
        </tr>
        
        
        <tr>
            <td>
                Imagen:
            </td>
            <td>
                <input type="file" name="imagen" required="">
            </td>
            
                
        </tr>
        <tr>
            <td>
                <input type="submit" value="Agregar">
            </td>
        </tr>
    </table>
    
    
</form>
