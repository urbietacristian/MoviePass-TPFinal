<?php
  require_once(VIEWS_PATH."navGuest.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
<h1>Películas en <?php echo $cinema->getName()?></h1>
  <ul class="carta-grid">    
    <?php
        foreach($movie_list as $movie){ 
      ?>                                        
          <li class="carta">
          <a href='<?php echo FRONT_ROOT; ?>MovieShow/ShowFunctionsByMovie/<?php echo $movie->getIdApi()?>'>     
            <div class="carta-body carta-image"><img src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage()?>'/></div>
            <div class="carta-footer"><p><?php echo $movie->getName()?></p></div>                          
          </a>
        </li>         
      <?php
        }
      ?>
  </div>
</main>