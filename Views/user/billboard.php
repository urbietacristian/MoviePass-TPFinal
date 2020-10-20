<?php
if(isset($_SESSION['loggedUser']))
{
    if ($_SESSION['loggedUser']->getRol() == 'admin'){
    require_once(VIEWS_PATH."navAdmin.php");
  }
  else{
    require_once(VIEWS_PATH."navUser.php");
  }
}
else
{
  header("location:../Home/Index");
  exit;
}


?>

<div align="center" id="mainav">
    <?php 
    
    foreach($genre_list as $value){ 
    ?>
      <li><a href="<?php echo FRONT_ROOT; ?>Billboard/showMovies/<?php echo $value->getId()?>"><?php echo $value->getName()?></a></li>
    
    <?php } ?>

</div>


<div id="mainav">
    <?php 
    
    foreach($movie_list as $movie){
                    
        //echo "<li><img  src='http://image.tmdb.org/t/p/w300".$movie->getImage()."'><p>".$movie->getName()."</p></li>";
        echo "<li>";
        echo    "<div class='card' >";
        echo        "<div ><img src='http://image.tmdb.org/t/p/w185".$movie->getImage()."'></div>";
        echo           "<div class='title'>
                          <p>".$movie->getName()."</p>
                     </div>";
        echo    "</div>";
        echo "</li>";
        }
        ?>

</div>




