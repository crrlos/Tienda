<div id="pago_transferencia">
    <form action="http://www.impuso2015.tk/controladores/controladorPago.php" method="post">
        <input type="hidden" name="pago_transferencia">
        <table>
            <tr>
                <td>
                    <b>Banco:</b>
                </td>
                <td>
                    <select name="bancos">
                        <option value="1">Scotiabank</option>
                        <option value="2">Agrícola</option>
                        <option value="3">Citi</option>
                        <option value="4">HSBC</option>
                        <option value="5">Davivienda</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Código:</b>
                </td>
                <td>
                    <input type="text" name="txtTransferencia">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Enviar">
                </td>
            </tr>
        </table>
        
    </form>
</div>