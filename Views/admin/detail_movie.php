<?php
require_once(VIEWS_PATH."navAdmin.php");
?>


<section align='center'>
    <img src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage();?>'>
    <h1>Titulo: <?php echo $movie->getName();?></h1>
    <p>Descripcion: <?php echo $movie->getDescription();?></p>
    <p>Idioma: <?php echo $movie->getLanguage();?></p>
    <p>Duracion: <?php echo $movie->getDuration();?> minutos</p>
    <p>Fecha de lanzamiento: <?php echo $movie->getReleaseDate();?> </p>
    <hr align="right" noshade="noshade" size="1" width="50%" />


    <a href="<?php echo FRONT_ROOT; ?>MovieShow/ShowAddFunctionCinema/<?php echo $movie->getIdApi()?>">Agregar Funcion</a>

    <div align="left" id="mainav">        
        <?php
        foreach($displayList as $value){
        ?>            
        <li>
            <div class='card'>
            Cine:  <?php echo $value['cinema_name'] ?> <br>
            Sala:  <?php echo $value['room_name'] ?> <br>
            Capacidad:  <?php echo $value['capacity'] ?> <br>
            Precio:  <?php echo $value['price'] ?> <br>
            Dia:  <?php echo $value['day'] ?> <br>
            Horario:  <?php echo $value['time'] ?> <br>
            
            </div>
        </li>    
        <?php
        } 
        ?>
    </div>    



</section>
