<?php
  if(isset($_SESSION['msg']))
          {
              echo '<script language="javascript">alert("'.$_SESSION['msg'].'");</script>';
              $_SESSION['msg'] = null;
          }
?>

<div class="wrapper row1">
<header > 
    <!-- <div id="logo" class="imgl"> -->
    <div class="nav-left">
      <a href="<?php echo FRONT_ROOT; ?>Movie/ShowMovies"><img  src="<?php echo IMG_PATH."logo.png"?>"/> Movie Pass</a>    
    </div>
    <div class="nav-right">    
      <a href="<?php echo FRONT_ROOT; ?>Movie/showActiveMovies">Lista de Peliculas en Cartelera</a>
      <a href="<?php echo FRONT_ROOT; ?>Cinema/showActiveCinemas">Lista de Cines</a>
      <a href="<?php echo FRONT_ROOT; ?>User/ShowLoginView">Ingresar</a>
    </div>
</div>
<div  class="body">