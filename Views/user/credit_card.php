<?php
require_once(VIEWS_PATH."navUser.php");
?>

<br>
<br>
<div id="form" align='center'>
    
    <img src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage();?>'>
    <br><br>
    <aside>
    <h1>Titulo: <?php echo $movie->getName();?></h1>
    <p>Cine: <?php echo $cinema->getName();?></p>
    <p>Sala: <?php echo $room->getName();?></p>
    <p>Cantidad de tickets: <?php echo $ticket_count;?></p>
    <p>Subtotal: <?php echo $subtotal;?></p>
    <p>Total con descuentos: <?php echo $total;?></p>
    <p>Funcion: <?php echo $movieshow_datetime;?></p>

    <form action="<?php echo FRONT_ROOT ?>Purchase/newPurchase"  method="POST" class="login-form bg-dark-alpha p-5 bg-light">
    <script
        src="https://www.mercadopago.com.ar/integrations/v1/web-tokenize-checkout.js"
        data-public-key="TEST-2a5d0b3a-05f0-42b8-8dd4-41de491cd5b8"
        data-button-label="Pagar"
        data-transaction-amount=<?php echo $total; ?>>
    </script>
    <br>
    <input name='id_movieshow' type="hidden" value='<?php echo $id_movieshow?>'>
    <input name='ticket_count' type="hidden" value='<?php echo $ticket_count?>' min="1" required>
    <input name='discount' type="hidden" value='<?php echo $discount?>' min="1" required>
    <input name='subtotal' type="hidden" value='<?php echo $subtotal?>' min="1" required>
    <input name='total' type="hidden" value='<?php echo $total?>' min="1" required>
    <div class="form-group">
    </form>
    </aside>
</div>