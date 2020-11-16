<div class="form">
        <form action="<?php echo FRONT_ROOT ?>Show/register"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
        <div class="form-group">
            <label for="tarjeta">Seleccione su tipo de tarjeta:</label>
            <select name="card_type" id="tarjeta" required>
                <option value="credit">Credito</option>
                <option value="debit">Debito</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Numero de la tarjeta:</label>
            <input type="number" name="card_number" class="form-control form-control-lg"  title="Card Number" minlength='16' maxlength="16" required>
        </div>
        <div class="form-group">
            <label for="">Nombre del titular de la tarjeta:</label>
            <input type="text" name="card_name" class="form-control form-control-lg" title="Card Name" required>
        </div>
        <div class="form-group">
            <label for="">Codigo de seguridad:</label>
            <input type="number" name="card_security_key" class="form-control form-control-lg" title="Card Key" minlength='3' maxlength="3" required>
        </div>
        <div class="form-group">
        <div class="btn_cont">
            <button class="btn btn-primary btn-block btn-lg" type="submit">Aceptar</button>
        </div>
        </form>
</div>