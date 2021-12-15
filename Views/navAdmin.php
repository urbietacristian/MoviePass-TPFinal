<?php
  use Controllers\ValidationController as ValidationController;

  ValidationController::getInstance()->validateAdmin();
  if(isset($_SESSION['msg']))
    {
      echo '<script language="javascript">alert("'.$_SESSION['msg'].'");</script>';
      $_SESSION['msg'] = null;
    }
?>

<div class="nav">
  <header > 
    <div style="vertical-align: middle;" id="logo" class="imgl">
      <h1><a href="<?php echo FRONT_ROOT; ?>Movie/ShowMovies"><img  src="<?php echo IMG_PATH."logo.png"?>" > Movie Pass</a></h1>
    </div>    
    <nav class="list">
      <li ><a href="<?php echo FRONT_ROOT; ?>Purchase/ShowSalesView">Totales vendidos</a></li>
      <li ><a href="<?php echo FRONT_ROOT; ?>Purchase/ShowTicketsSoldView">Tickets vendidos</a></li>
      <li ><a href="<?php echo FRONT_ROOT; ?>Movie/showMovies">Listar Peliculas</a></li>
      <li ><a href="<?php echo FRONT_ROOT; ?>Cinema/ShowRemoveView">Listar Cines</a></li>
      <li ><a href="<?php echo FRONT_ROOT; ?>Movie/UpdateMovies">Actualizar Peliculas</a></li>
      <li ><a href="<?php echo FRONT_ROOT; ?>User/ShowRegisterAdminView">Registrar Administrador</a></li>
      <li ><a href="<?php echo FRONT_ROOT; ?>User/logout">Logout</a></li>        
      <li ><a href="<?php echo FRONT_ROOT; ?>Movie/ShowActiveMovies">Vista Usuario</a></li>
    </nav> 
  </header>
</div>
<div >