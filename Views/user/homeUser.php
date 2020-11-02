<?php
    require_once(VIEWS_PATH."navUser.php");
?>

<div align="center" id="mainav">
  <li><a href="<?php echo FRONT_ROOT; ?>Movie/showActiveMovies/">Todas las Películas</a></li>
  <li><a href="<?php echo FRONT_ROOT; ?>Movie/showActiveMovies/">Ordenar Por Fecha</a></li>
    <?php 
    
    foreach($genre_list as $value){ 
    ?>
      <li>
        <a href="<?php echo FRONT_ROOT; ?>Movie/showActiveMovies/<?php echo $value->getId()?>"><?php echo $value->getName()?></a>
      </li>    
    <?php } ?>

</div>


<div id="mainav">
    <?php 
    
    foreach($movie_list as $movie){ 
      ?>
                    
       <li>
        
        <div class='card'>
           <div ><img src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage()?>'></div>
              <div class='title' style='display:block;text-overflow: ellipsis;width: 165px;overflow: hidden; white-space: nowrap'>
                  <p><?php echo $movie->getName()?></p>
              </div>
        </div>
        
        </li>
        <?php
        }
        ?>

</div>
