<?php
  use Controllers\ValidationController as ValidationController;

  ValidationController::getInstance()->validateAdmin();
  if(isset($_SESSION['msg']))
    {
      echo '<script language="javascript">alert("'.$_SESSION['msg'].'");</script>';
        $_SESSION['msg'] = null;
    }
?>

<div >
  <header > 
    <!-- <div id="logo" class="imgl"> -->
    <div class="nav-left">
      <a href="<?php echo FRONT_ROOT; ?>Movie/ShowMovies"><img  src="<?php echo IMG_PATH."logo.png"?>"/> Movie Pass</a>    
    </div>
    <div class="nav-right">    
      <a href="<?php echo FRONT_ROOT; ?>Purchase/ShowSalesView">Totales vendidos</a>
      <a href="<?php echo FRONT_ROOT; ?>Purchase/ShowTicketsSoldView">Tickets vendidos</a>
      <a href="<?php echo FRONT_ROOT; ?>Movie/showMovies">Listar Peliculas</a>
      <a href="<?php echo FRONT_ROOT; ?>Cinema/ShowRemoveView">Listar Cines</a>
      <a href="<?php echo FRONT_ROOT; ?>Movie/UpdateMovies">Actualizar Peliculas</a>
      <a href="<?php echo FRONT_ROOT; ?>User/ShowRegisterAdminView">Registrar Administrador</a>
      <a href="<?php echo FRONT_ROOT; ?>User/logout">Logout</a>    
      <a href="<?php echo FRONT_ROOT; ?>Movie/ShowActiveMovies">Vista Usuario</a>
    </div>

  </header>
</div>
<div class="body" >