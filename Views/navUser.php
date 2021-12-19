<?php

use chillerlan\QRCode\QRCode;
use Controllers\ValidationController as ValidationController;

	ValidationController::getInstance()->validateUser();
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
        <a href="<?php echo FRONT_ROOT; ?>Movie/showActiveMovies">Peliculas</a>
		<a href="<?php echo FRONT_ROOT; ?>Cinema/showActiveCinemas">Cines</a>
		<a href="<?php echo FRONT_ROOT; ?>Purchase/showMyTicketsView">Mis Entradas</a>
		<a href="<?php echo FRONT_ROOT; ?>User/logout">Logout</a>
      <?php if($_SESSION['loggedUser']->getRol() == 1){?> <a href="<?php echo FRONT_ROOT; ?>Movie/showMovies">Vista Admin</a><?php }?>
    </div>
</div>
<div  class="body">