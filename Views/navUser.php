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
	<header id="header" class="hoc clear"> 
		<div id="logo" class="fl_left">
		<h1><a href="<?php echo FRONT_ROOT; ?>Movie/ShowMovies"><img  src="<?php echo IMG_PATH."logo.png"?>" > Movie Pass</a></h1>
		</div>
		<nav id="mainav" class="fl_right">
			<li class="active"><a href="<?php echo FRONT_ROOT; ?>Movie/showActiveMovies">Peliculas</a></li>
			<li class="active"><a href="<?php echo FRONT_ROOT; ?>Cinema/showActiveCinemas">Cines</a></li>
			<li class="active"><a href="<?php echo FRONT_ROOT; ?>Purchase/showMyTicketsView">Mis Entradas</a></li>
			<li class="active"><a href="<?php echo FRONT_ROOT; ?>User/logout">Logout</a></li>
			<?php if($_SESSION['loggedUser']->getRol() == 1){?> <li class="active"><a href="<?php echo FRONT_ROOT; ?>Movie/showMovies">Vista Admin</a></li><?php }?>
		</nav> 
	</header>
</div>
<div  class="hoc">