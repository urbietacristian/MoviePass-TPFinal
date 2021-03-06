<?php
  require_once(VIEWS_PATH."navGuest.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
  <div id="mainav" align = "center">
    <h1>Películas en <?php echo $cinema->getName()?></h1>
    <?php        
      foreach($movie_list as $movie){
    ?>                        
    <li>            
      <div class='card'>
        <a href='<?php echo FRONT_ROOT; ?>MovieShow/ShowMovieShowByCinema?id_movie=<?php echo $movie->getIdApi()?>&id_cinema=<?php echo $id_cinema?>'>
        <div >
          <img src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage()?>'>
        </div>
        <div class='title' style='display:block;text-overflow: ellipsis;width: 270px;overflow: hidden; white-space: nowrap'>
          <p><?php echo $movie->getName()?></p>
        </div>
        </a>
      </div>
    </li>
    <?php
      }
    ?>
  </div>
</main>