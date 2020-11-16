<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="form">
                        <form action="<?php echo FRONT_ROOT ?>Show/register"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                            <div class="form-group">
                                <label for="tarjeta">Choose a Card Type:</label>
                                <select name="tarjeta" id="tarjeta" required>
                                    <option value="credito">Credito</option>
                                    <option value="debito">Debito</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Card Number</label>
                                <input type="number" name="card_number" class="form-control form-control-lg" placeholder="Enter Card Number" title="Card Number" oninvalid="this.setCustomValidity('Insert a Valid Card')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                                <label for="">Card Owner Name</label>
                                <input type="text" name="card_name" class="form-control form-control-lg" placeholder="Enter Card Name" title="Card Name" oninvalid="this.setCustomValidity('Insert a Valid Name')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                                <label for="">Card Key</label>
                                <input type="number" name="card_key" class="form-control form-control-lg" placeholder="Enter Card Key" title="Card Key" oninvalid="this.setCustomValidity('Insert a Valid Key')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                            <div class="btn_cont">
                                <button class="btn btn-primary btn-block btn-lg" type="submit">Submit Payment Info</button>
                            </div>
                        </form>
                    </div>
</body>
</html>