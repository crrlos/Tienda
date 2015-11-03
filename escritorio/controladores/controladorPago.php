<?php

require_once 'config.php';

class ControladorPago {

    function procesarPagoCompletado() {

        $idusuario = $_POST['custom'];
        $pedido = PedidosQuery::create()->filterByEstado('pendiente')->filterByIdcliente($idusuario)->findOne();
        $pedido->setEstado('cancelado');
        $pedido->save();
        $venta = new Ventas();
        $venta->setIdpedido($pedido->getIdpedido());
        $venta->setFecha(date('Y-m-d H:i:s'));
        $venta->setFormapago('PAYPAL');
        $venta->setCodigotransaccion($_POST['txn_id']);
        $venta->save();
    }

    function procesarFormaDePago() {
        /* pago por paypal */
        if ($_POST['formadepago'] == 1) {/* pago por paypal */

            if (isset($_SESSION['usuario'])) {
                $idusuario = UsuariosQuery::create()->findOneByNombreusuario($_SESSION['usuario'])->getIdusuario();
                $pedido = PedidosQuery::create()->filterByIdcliente($idusuario)->filterByEstado('pendiente')->findOne();
                $detallePedido = $pedido != null ? $pedido->getDetallepedidoss() : null;
                if ($detallePedido != null) {
                    include __DIR__ . '/../paginas/generarPaypal.php';
                }
            }
        } elseif ($_POST['formadepago'] == 2) {/* pago por depósito o transferencia bancaria */
        }
    }

    function mostrarDetalles() {
        include __DIR__ . '/../paginas/detallePago.php';
    }

    function iniciar() {
        if (isset($_POST['payment_status'])) {//verifica si fue invocado por Paypal
            if ($_POST['payment_status'] == 'Completed')
                procesarPagoCompletado();
        } else {
            //fue invocado por la aplicación
            $opcion = isset($_POST['oppago']) ? $_POST['oppago'] : '';
            switch ($opcion) {
                case 1:
                    $this->procesarFormaDePago();
                    break;
                default :
                    $this->mostrarDetalles();
            }
        }
    }
    
    function __destruct() {
        
    }

}

$controlador = new ControladorPago();
$controlador->iniciar();



