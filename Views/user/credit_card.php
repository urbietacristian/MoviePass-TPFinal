<?php
require_once(VIEWS_PATH."navUser.php");
?>

<div class="form" align='center'>
        <t>Ingrese la informacion de su tarjeta</t>
        <form action="<?php echo FRONT_ROOT ?>Purchase/newPurchase"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
        
        <div class="form-group">
            <label for="">Numero de la tarjeta:</label>
            <input type="text" name="card_number" class="form-control form-control-lg"  title="Card Number" range=[0,9] minlength='16' maxlength="16" required>
        </div><br>
        <div class="form-group">
            <label for="">Nombre del titular de la tarjeta:</label>
            <input type="text" name="card_name" class="form-control form-control-lg" title="Card Name" required>
        </div>
        <br>
        <div class="form-group">
            <label for="">Codigo de seguridad:</label>
            <input type="text" name="card_security_key" class="form-control form-control-lg" title="Card Key" range=[0,9] minlength='3' maxlength="3" required>
        </div>
        <br>
        <input name='id_movieshow' type="hidden" value='<?php echo $_POST['id_movieshow']?>'>
        <input name='ticket_count' type="hidden" value='<?php echo $_POST['ticket_count']?>' min="1" required>
        <div class="form-group">
        <div class="btn_cont">
            <button class="btn btn-primary btn-block btn-lg" type="submit">Aceptar</button>
        </div>
        </form>
</div>