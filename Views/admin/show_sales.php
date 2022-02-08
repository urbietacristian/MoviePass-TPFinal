
<?php
require_once(VIEWS_PATH."navAdmin.php");
?>
<div>
    <br><br>
    <aside>
        <h1>Totales Vendidos por Pelicula</h1>
        <form action="<?php echo FRONT_ROOT ?>Purchase/ShowSalesByMovieView"   method='get'>
            <select type="select" name="id_movie" required>
                <?php foreach($movieList as $movie){ ?>
                    <option value = "<?php echo $movie->getIdApi() ?>"><?php echo $movie->getName()?></option>
                <?php } ?>
            </select> 
            <p>Fecha Inicial</p>
            <input type="date" name="dateIn" min = <?php echo date('2020-06-00'); ?> value = <?php echo date('Y-m-d'); ?> />
            <p>Fecha Final</p>
            <input type="date" name="dateOut" min = <?php echo date('2020-06-00'); ?> value = <?php echo date('Y-m-d'); ?> />
            <br>
            <button type="submit">Buscar</button>
        </form>
    </aside>
                    
    <aside >
        <h1>Totales Vendidos por Cine</h1>
        <form action="<?php echo FRONT_ROOT ?>Purchase/ShowSalesByCinemaView"   method='get'>
            <select type="select" name="id_cinema" required>
                <?php foreach($cinemaList as $cinema){ ?>
                    <option value = "<?php echo $cinema->getId() ?>"><?php echo $cinema->getName()?></option>
                <?php } ?>
            </select> 
            <p>Fecha Inicial</p>
            <input type="date" name="dateIn" min = <?php echo date('2020-06-00'); ?> value = <?php echo date('Y-m-d'); ?> />
            <p>Fecha Final</p>
            <input type="date" name="dateOut" min = <?php echo date('2020-06-00'); ?> value = <?php echo date('Y-m-d'); ?> />
            <br>
            <button type="submit">Buscar</button>
        </form>
    </aside>
</div>
<br><br>
<div>
    <?php if(isset($_SESSION['totals'])){  ?>
    <h1>Totales Vendidos para '<?php echo $_SESSION['totals']?>': $<?php echo $totales_vendidos ?> entre el <?php echo $dateIn; echo " y el "; echo $dateOut; $_SESSION['totals'] = NULL;?> </h1>
    <?php }else echo "<br><br><br>"  ?>
</div>