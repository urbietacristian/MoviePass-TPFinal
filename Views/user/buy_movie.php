<?php
    require_once(VIEWS_PATH."navUser.php");
?>
<section align='center'>
    <img src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage();?>'>
    <h1>Titulo: <?php echo $movie->getName();?></h1>
    <p>Descripcion: <?php echo $movie->getDescription();?></p>
    <p>Idioma: <?php echo $movie->getLanguage();?></p>
    <p>Duracion: <?php echo $movie->getDuration();?> minutos</p>
    <p>Fecha de lanzamiento: <?php echo $movie->getReleaseDate();?></p>


    <div align="center" id="mainav">        
        <?php
        foreach($displayList as $value){
        ?>            
        <li>
            <div class='card'>
            Cine:  <?php echo $value['cinema_name'] ?> <br>
            Sala:  <?php echo $value['room_name'] ?> <br>
            Capacidad:  <?php echo $value['capacity'] ?> <br>
            Precio:  $<?php echo $value['price'] ?> <br>
            Dia:  <?php echo $value['day'] ?> <br>
            Horario:  <?php echo $value['time'] ?>
            <a href="<?php echo FRONT_ROOT; ?>Purchase/ShowPurchaseView?title=<?php echo $movie->getName();?>&cinema=<?php echo $value['cinema_name']?>&price=<?php echo $value['price'] ?>&id_movieshow=<?php echo $value['id_movieshow'] ?>">Comprar</a> 
            </div>
        </li>   
        
        <?php
        } 
        ?>
    </div>    
</section>