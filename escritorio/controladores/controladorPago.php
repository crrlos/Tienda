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
            require_once __DIR__ . '/../paginas/pago_transferencia.php';
        } elseif ($_POST['formadepago'] == 3) {/*         * pago con pagadito * */
            if (isset($_SESSION['usuario'])) {
                $idusuario = UsuariosQuery::create()->findOneByNombreusuario($_SESSION['usuario'])->getIdusuario();
                $pedido = PedidosQuery::create()->filterByIdcliente($idusuario)->filterByEstado('pendiente')->findOne();
                $detallePedido = $pedido != null ? $pedido->getDetallepedidoss() : null;
                if ($detallePedido != null) {
                    include __DIR__ . '/../paginas/generarPagadito.php';
                }
            }
        }
    }

    function mostrarDetalles() {

        include __DIR__ . '/../paginas/detallePago.php';
    }

    function iniciar() {
        if (isset($_POST['payment_status'])) {//verifica si fue invocado por Paypal
            if ($_POST['payment_status'] == 'Completed')
                procesarPagoCompletado();
        } else if (isset($_POST['pago_transferencia'])) {//verifica si es un pago por tranferencia
            $idusuario = UsuariosQuery::create()->findOneByNombreusuario($_SESSION['usuario'])->getIdusuario();
            $pedido = PedidosQuery::create()->filterByIdcliente($idusuario)->filterByEstado('pendiente')->findOne();
            $banco;
            switch ($_POST['bancos']) {
                case 1:
                    $banco = 'Scotiabank';
                    break;
                case 2:
                    $banco = 'Agrícola';
                    break;
                case 3:
                    $banco = 'Citi';
                    break;
                case 4:
                    $banco = 'HSBC';
                    break;
                case 5:
                    $banco = 'Davivienda';
                    break;
            }
            $venta = new Ventas();
            $venta->setIdpedido($pedido->getIdpedido());
            $hora = new DateTime();
            $hora->setTimezone(new DateTimeZone('America/El_Salvador'));
            $hora->format("Y-m-d H:i:s");

            $venta->setFecha($hora);
            $venta->setFormapago($banco);
            $venta->setCodigotransaccion($_POST['txtTransferencia']);
            $venta->save();
            $pedido->setEstado('revision');
            $pedido->save();
            header("location:http://www.impuso201.tk/");
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



