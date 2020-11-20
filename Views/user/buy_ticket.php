<?php
require_once(VIEWS_PATH."navUser.php");
?>
<div align = 'center'>
    <h1>Comprar Entrada</h1>
    <h3>Película: <?php echo $title;?></h3>
    <p>Cine: <?php echo $cinema;?></p>
    <p>Precio por entrada: <?php echo $price;?></p>


    
    <form action="<?php echo FRONT_ROOT ?>Purchase/ShowCreditCardView"   method='post' >
    
        <div class="form-group">
            <label for="">Cantidad de entradas:</label>
            <input type="number" name="ticket_count" min="1" class="form-control form-control-lg" required>
        </div>
        <input name='id_movieshow' type="hidden" value='<?php echo $id_movieshow?>'>
        <br>
        <button type="submit">Comprar</button>
    </form>
</div>

    
