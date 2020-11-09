<?php
  use Controllers\ValidationController as ValidationController;

  ValidationController::getInstance()->validateUser();
?>

<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <div id="logo" class="fl_left">
      <h1><a href="<?php echo FRONT_ROOT; ?>Movie/ShowActiveMovies">Movie Pass</a></h1>
    </div>      
    <nav id="mainav" class="fl_right">
      <li class="active"><a href="<?php echo FRONT_ROOT; ?>Movie/showActiveMovies">Lista de Peliculas en Cartelera</a></li>
      <li class="active"><a href="<?php echo FRONT_ROOT; ?>Cinema/showActiveCinemas">Lista de Cines</a></li>
      <li class="active"><a href="<?php echo FRONT_ROOT; ?>User/logout">Logout</a></li>
    </nav> 
  </header>
</div>