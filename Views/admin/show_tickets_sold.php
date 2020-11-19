
<?php
require_once(VIEWS_PATH."navAdmin.php");
?>
    <div id="sales" align="center">
        <br><br>
        <aside>
            <h1>Ventas de funciones por Pelicula</h1>
            <form action="<?php echo FRONT_ROOT ?>Purchase/ShowSoldTicketsByMovieView"   method='get'>
                <select type="select" name="id_movie" required>
                    <?php foreach($movieList as $movie){ ?>
                        <option value = "<?php echo $movie->getIdApi() ?>"><?php echo $movie->getName()?></option>
                    <?php } ?>
                </select> 
                <br>
                <button type="submit">Buscar</button>
            </form>
        </aside>
                        
        <aside >
            <h1>Ventas de funciones por Cine</h1>
            <form action="<?php echo FRONT_ROOT ?>Purchase/ShowSoldTicketsByCinemaView"   method='get'>
                <select type="select" name="id_cinema" required>
                    <?php foreach($cinemaList as $cinema){ ?>
                        <option value = "<?php echo $cinema->getId() ?>"><?php echo $cinema->getName()?></option>
                    <?php } ?>
                </select> 
                <br>
                <button type="submit">Buscar</button>
            </form>
        </aside>
    </div>
    <br><br>
    <div id='mainav'>
        <?php if(isset($_SESSION['totals'])){ 
            foreach($ticketList as $value){ ?>            
                <li>
                    <div class='planecard'>
                    Movieshow:  <?php echo $value['id_movieshow'] ?> <br>
                    Vendidos:  <?php echo $value['sold']; echo ' / '; echo $value['capacity']; ?> <br>
                    </div>
                </li>    
        <?php }} else echo "<br><br><br>"  ?>
    </div>