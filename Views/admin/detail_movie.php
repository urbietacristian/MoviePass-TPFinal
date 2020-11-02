<?php
require_once(VIEWS_PATH."navAdmin.php");
?>


<section align='center'>
<img src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage()?>'>
<h1>Titulo: <?php echo $movie->getName()?></h1>
<p>Descripcion: <?php echo $movie->getDescription()?></p>
<p>Idioma: <?php echo $movie->getLanguage()?></p>
<p>Duracion: <?php echo $movie->getDuration()?> minutos</p>

<a href="<?php echo FRONT_ROOT; ?>MovieShow/ShowAddFunctionCinema/<?php echo $movie->getIdApi()?>">Agregar Funcion</a>


</section>
