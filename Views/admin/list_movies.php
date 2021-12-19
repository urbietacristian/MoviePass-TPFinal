<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="movies" >
    <div class="genre-list">
      <li>
        <a href="<?php echo FRONT_ROOT; ?>Movie/showMovies/">Todas las Películas</a>
      </li>
        <?php        
          foreach($genre_list as $value){
        ?>
          <li>
            <a href="<?php echo FRONT_ROOT; ?>Movie/showMovies/<?php echo $value->getId()?>"><?php echo $value->getName()?></a>
          </li>    
        <?php
          } 
        ?>
    </div>
    <ul class="carta-grid" >
      <?php
        foreach($movie_list as $movie){ 
      ?>                                        
          <li class="carta ">
          <!-- <a href='<?php echo FRONT_ROOT; ?>Movie/ShowMovieDetail/<?php echo $movie->getIdApi()?>'>      -->
            <div class="carta-body carta-image"><img src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage()?>'/></div>
            <div class="carta-footer"><p><?php echo $movie->getName()?></p></div>                          
          <!-- </a> -->
        </li>         
      <?php
        }
      ?>
    </ul>
</div>



