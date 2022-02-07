<?php
require_once(VIEWS_PATH."navUser.php");
?>

<div class="movies">
    <h1>Películas en <?php echo $cinema->getName()?></h1>
    <ul class="carta-grid" >
        <?php        
        foreach($movie_list as $movie){
        ?>         
        <div class='carta'>
            <a href='<?php echo FRONT_ROOT; ?>MovieShow/ShowFunctionsByMovie?id_movie=<?php echo $movie->getIdApi()?>&cinema_name=<?php echo $cinema->getName()?>'>
            <div class="carta-body carta-image">
                <img  src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage()?>'>
            </div>
            <div class="carta-footer">
                <p><?php echo $movie->getName()?></p>
            </div>
            </a>
        </div>
        <?php
        }
        ?>
    </ul>
</div>
