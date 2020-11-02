<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>

<div align="center" id="mainav">
  <li>
    <a href="<?php echo FRONT_ROOT; ?>Movie/showMovies/">Todas las Películas</a>
  </li>
    <?php 
    
    foreach($genre_list as $value){ 
    ?>
      <li>
        <a href="<?php echo FRONT_ROOT; ?>Movie/showMovies/<?php echo $value->getId()?>"><?php echo $value->getName()?></a>
      </li>    
    <?php } ?>

</div>


<div id="mainav">
    <?php 
    
    foreach($movie_list as $movie){
                    
        //echo "<li><img  src='http://image.tmdb.org/t/p/w300".$movie->getImage()."'><p>".$movie->getName()."</p></li>";
        echo "<li>";
        echo    "<div class='card'>";
        echo        "<div ><img src='http://image.tmdb.org/t/p/w185".$movie->getImage()."'></div>";
        echo           "<div class='title' style='display:block;text-overflow: ellipsis;width: 165px;overflow: hidden; white-space: nowrap'>
                          <p>".$movie->getName()."</p>
                     </div>";
        echo    "</div>";
        echo "</li>";
        }
        ?>

</div>
