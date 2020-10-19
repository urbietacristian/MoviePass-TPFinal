
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


if (!isset($_SESSION["loggedUser"])){
  header("location:../Home/Index");
  exit;
}


?>
  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <div id="logo" class="fl_left">
        <h1><a href="#">Cervezas Artesanales</a></h1>
      </div>
      <!-- Add path routes below -->
      
      <nav id="mainav" class="fl_right">
        
            <li class="active"><a href="<?php echo FRONT_ROOT; ?>Cinema/ShowRemoveView">Editar / Eliminar Cine</a></li>
            <li class="active"><a href="<?php echo FRONT_ROOT; ?>Cinema/ShowAddView">Agregar Cine</a></li>
            <li class="active"><a href="<?php echo FRONT_ROOT; ?>User/logout">Logout</a></li>
        
    </nav> 
    </header>
  </div>