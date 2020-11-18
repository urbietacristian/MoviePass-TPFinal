
<?php
require_once(VIEWS_PATH."navAdmin.php");
?>
    <div id="sales" align="center">
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
                <input type="date" name="dateIn" min = <?php echo date('2020-06-00'); ?> />
                <p>Fecha Final</p>
                <input type="date" name="dateOut" min = <?php echo date('2020-06-00'); ?> />
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
                <input type="date" name="dateIn" min = <?php echo date('2020-06-00'); ?> />
                <p>Fecha Final</p>
                <input type="date" name="dateOut" min = <?php echo date('2020-06-00'); ?> />
                <br>
                <button type="submit">Buscar</button>
            </form>
        </aside>
    </div>