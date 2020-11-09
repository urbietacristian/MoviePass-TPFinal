
<!-- <div class="bgded overlay" style="background-color"=grey );"> 
  <div class="wrapper row0">
    <div id="topbar" class="hoc clear">   
      <div class="fl_right">     
        <ul class="nospace">
        </ul>
      </div>
    </div>
  </div> -->
  <?php


use DAO\CinemaDAO;
Use Models\User as User;
use Controllers\ValidationController as ValidationController;

use DAO\MovieDAO as MovieDAO;
use DAO\GenreDAO as GenreDAO;


ValidationController::getInstance()->validateAdmin();

?>
  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <div id="logo" class="fl_left">
        <h1><a href="<?php echo FRONT_ROOT; ?>Cinema/ShowAdminHomeView">Movie Pass</a></h1>
      </div>
      <!-- Add path routes below -->
      
      <nav id="mainav" class="fl_right">
        <li class="active"><a href="<?php echo FRONT_ROOT; ?>Movie/showMovies">Listar Peliculas</a></li>
        <li class="active"><a href="<?php echo FRONT_ROOT; ?>Cinema/ShowRemoveView">Listar Cines</a></li>
        <li class="active"><a href="<?php echo FRONT_ROOT; ?>Movie/UpdateMovies">Actualizar Peliculas</a></li>
        <li class="active"><a href="<?php echo FRONT_ROOT; ?>User/logout">Logout</a></li>        
      </nav> 
    </header>
  </div>