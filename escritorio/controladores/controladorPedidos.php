<?php

if (session_status() == PHP_SESSION_NONE)
    session_start();

require_once 'config.php';
$opcion = isset($_GET['opcarrito']) ? $_GET['opcarrito'] : '';
/* * ********************************************
 * panel de control
 * 1 - agregar un producto al carrito
 * 2 - actualizar o eliminar los productos del carrito
 * 
 */
switch ($opcion) {
    case '1':
        agregarProducto();
        break;
    case '2':
        actualizarEliminar();
        break;
    case '3':
        mostrarHistorial();
        break;
    default:
        mostrarProductos();
        break;
}

/*
 * ********************************************
 */

function mostrarProductos() {

    if (isset($_SESSION['usuario'])) {
        $idusuario = UsuariosQuery::create()->findOneByNombreusuario($_SESSION['usuario'])->getIdusuario();
        $pedidos = PedidosQuery::create()->filterByIdcliente($idusuario)->filterByEstado('pendiente')->findOne();
        $productos = $pedidos != null ? $pedidos->getDetallepedidoss() : null;
        if ($productos != null) {
            require_once __DIR__ . '/../paginas/carrito.php';
        } else {
            echo 'carrito vacio';
        }
    }
}

function agregarProducto() {

    if (isset($_SESSION['usuario'])) {// si hay sesión de usuario iniciada
        $idusuario = UsuariosQuery::create()->findOneByNombreusuario($_SESSION['usuario'])->getIdusuario();
        $pedido = PedidosQuery::create()->filterByIdcliente($idusuario)->filterByEstado('pendiente')->findOne();
        if ($pedido == null) {//si el pedido no se ha creado
            //crear el pedido
            $pedido = new Pedidos();
            $pedido->setIdcliente($idusuario);
            $pedido->setEstado('pendiente');
            $pedido->save();
            //insertar producto
            agregar($pedido);
        } else {//si el pedido existe
            $detallePedido = $pedido->getDetallepedidoss();

            $existe = false;
            //se recorren los productos agregados en el pedido
            foreach ($detallePedido as $detalle) {
                /* si se encuentra el producto se actualiza su valor */
                if ($detalle->getIdproducto() == $_GET['idproducto']) {
                    $detalle->setCantidad($detalle->getCantidad() + 1);
                    $detalle->save();
                    $existe = true;
                    break;
                }
            }
            /* si no se encontró el producto, se agrega */
            if (!$existe) {
                agregar($pedido);
            }
            
        }
        header("location:http://www.impuso2015.tk/carrito");
    }
}

function actualizarEliminar() {

    if ($_POST['opcion'] == 'Actualizar') {
        actualizarProductosCarrito();
    } elseif ($_POST['opcion'] == 'Eliminar') {
        eliminarProductosCarrito();
    }
}

function actualizarProductosCarrito() {
    if (isset($_POST['seleccion'])) {
        $i = 0;
        foreach ($_POST['seleccion'] as $value) {
            $detallePedido = DetallepedidosQuery::create()->findOneByIddetallepedido($value);
            if ($_POST['cantidad'][$i] == 0) {
                $detallePedido->delete();
            } elseif ($_POST['cantidad'][$i] > 0) {
                $detallePedido->setCantidad($_POST['cantidad'][$i]);
                $detallePedido->save();
            }

            ++$i;
        }
    }
}

function eliminarProductosCarrito() {
    if (isset($_POST['seleccion'])) {

        foreach ($_POST['seleccion'] as $value) {
            $detallePedido = DetallepedidosQuery::create()->findOneByIddetallepedido($value);
            $detallePedido->delete();
        }
    }
}

function agregar($pedido){
    $detallePedido = new Detallepedidos();
                $detallePedido->setIdpedido($pedido->getIdpedido());
                $detallePedido->setIdproducto($_GET['idproducto']);
                $detallePedido->setCantidad(1);
                $detallePedido->setPrecio(ProductosQuery::create()->findOneByIdproducto($_GET['idproducto'])->getPrecio());
                $detallePedido->save();
}

function mostrarHistorial(){
  if(isset($_SESSION['usuario']))
  {
      $usuario = UsuariosQuery::create()->findOneByNombreusuario($_SESSION['usuario']);
      $pedidos = PedidosQuery::create()->findByIdcliente($usuario->getIdusuario());
  }
}
