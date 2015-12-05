<?php

require_once 'config.php';

if (isset($_GET['opproducto']))
    $opcion = isset($_GET['opproducto']) ? $_GET['opproducto'] : '';
else
if (isset($_POST['opproducto']))
    $opcion = isset($_POST['opproducto']) ? $_POST['opproducto'] : '';

switch ($opcion) {
    case 1:
        detalleProducto();
        break;
    case 2:
        agregarProducto();
        break;
    default:
        mostrarProductos();
        break;
}

function mostrarProductos() {
    $productosSubcategoria = SubcategoriasQuery::create()->findOneByNombre(str_replace('-', ' ', $_GET['subcategoria']))->getProductoss();
    $total = $productosSubcategoria->count();
    $pagina = $_GET['pagina'];
    require_once __DIR__ . '/../paginas/productos.php';
}

function detalleProducto() {
    $producto = ProductosQuery::create()->findOneByIdproducto($_GET['idproducto']);
    $descuento = 1 - (DescuentosQuery::create()->findOneByIddescuento($producto->getIddescuento())->getValor() / 100);
    if (isset($producto)) {
        require_once __DIR__ . '/../plantillas/header.php';
        require_once __DIR__ . '/../paginas/producto_detalle.php';
        require_once __DIR__ . '/../plantillas/footer.php';
    }
}

function agregarProducto() {
    $directorio = __DIR__.'/../imagenes/'.$_POST['codigo'].'/';
    
    
    if(!file_exists($directorio)){
        mkdir ($directorio);
        
    }
    $target_path = $directorio;
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio.'large.jpg')) {
        echo "El archivo " . basename($_FILES['imagen']['name']) . " ha sido subido";
    } else {
        echo "Ha ocurrido un error, trate de nuevo!";
    }
    
    //Ruta de la imagen original
	$rutaImagenOriginal= $directorio.'large.jpg';
	
	//Creamos una variable imagen a partir de la imagen original
	$img_original = imagecreatefromjpeg($rutaImagenOriginal);
	
	//Se define el maximo ancho o alto que tendra la imagen final
	$max_ancho = 200;
	$max_alto = 200;
	
	//Ancho y alto de la imagen original
	list($ancho,$alto)=getimagesize($rutaImagenOriginal);
	
	//Se calcula ancho y alto de la imagen final
	$x_ratio = $max_ancho / $ancho;
	$y_ratio = $max_alto / $alto;
	
	//Si el ancho y el alto de la imagen no superan los maximos, 
	//ancho final y alto final son los que tiene actualmente
	if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
		$ancho_final = $ancho;
		$alto_final = $alto;
	}
	/*
	 * si proporcion horizontal*alto mayor que el alto maximo,
	 * alto final es alto por la proporcion horizontal
	 * es decir, le quitamos al alto, la misma proporcion que 
	 * le quitamos al alto
	 * 
	*/
	elseif (($x_ratio * $alto) < $max_alto){
		$alto_final = ceil($x_ratio * $alto);
		$ancho_final = $max_ancho;
	}
	/*
	 * Igual que antes pero a la inversa
	*/
	else{
		$ancho_final = ceil($y_ratio * $ancho);
		$alto_final = $max_alto;
	}
	
	//Creamos una imagen en blanco de tamaño $ancho_final  por $alto_final .
	$tmp=imagecreatetruecolor($ancho_final,$alto_final);	
	
	//Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
	imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	
	//Se destruye variable $img_original para liberar memoria
	imagedestroy($img_original);
	
	//Definimos la calidad de la imagen final
	$calidad=95;
	
	//Se crea la imagen final en el directorio indicado
	imagejpeg($tmp,$directorio.'small.jpg',$calidad);
        
        $url_imagen = $_SERVER['SERVER_NAME'].'/imagenes/'.$_POST['codigo'].'/';
        
        $producto = new Productos();
        $producto->setIdproducto($_POST['codigo']);
        $producto->setnombre($_POST['nombre']);
        $producto->setDetalle($_POST['detalle']);
        $producto->setDescripcion($_POST['descripcion']);
        $producto->setPrecio($_POST['precio']);
        $producto->setIdsubcategoria(1);
        $producto->setIddescuento(1);
        $producto->setCantidad($_POST['cantidad']);
        $producto->save();
}
