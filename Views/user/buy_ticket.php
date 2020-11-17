<?php
require_once(VIEWS_PATH."navUser.php");
?>



    <?php
    if(isset($_SESSION['msg']))
    {
        echo '<script language="javascript">alert("'.$_SESSION['msg'].'");</script>';
        $_SESSION['msg'] = null;
    }
    ?>

    <h1>Titulo: <?php echo $title;?></h1>
    <p>Cine: <?php echo $cinema;?></p>
    <p>Precio por entrada: <?php echo $price;?></p>


    <h1>Comprar Entrada</h1>
    <form action="<?php echo FRONT_ROOT ?>Purchase/ShowCreditCardView"   method='post' >
        <h1>Cantidad de entradas:</h1>
        <br>
        <input name='ticket_count' type="number" min="1" required>
        <br><br>
        <input name='id_movieshow' type="hidden" value='<?php echo $id_movieshow?>'>
        <br>
        <button type="submit">Comprar</button>
    </form>

