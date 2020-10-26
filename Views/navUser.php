<?php
Use Models\User as User;



if(!isset($_SESSION['loggedUser'])){
//  if (!$user->getRol() == 'user'){
    header("location:../Home/Index");
    exit;
 // }
}

?>

  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <div id="logo" class="fl_left">
        <h1><a href="#">Movie Pass</a></h1>
      </div>
      <!-- Add path routes below -->
      
      <nav id="mainav" class="fl_right">
        <li class="active"><a href="<?php echo FRONT_ROOT; ?>Billboard/showMovies">Lista de Peliculas</a></li>
        <li class="active"><a href="<?php echo FRONT_ROOT; ?>User/logout">Logout</a></li>
    </nav> 
    </header>
  </div>