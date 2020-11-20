<?php
  require_once(VIEWS_PATH."navUser.php");
?>

<div id="tickets">
    <br>
    <div id="mainav" align="center">
        <li class="active"><a href="<?php echo FRONT_ROOT; ?>Purchase/showMyTicketsView">Ordenar por Película</a></li>
        <li class="active"><a href="<?php echo FRONT_ROOT; ?>Purchase/showMyTicketsView/1">Ordenar por Fecha</a></li>
    </div> 
</div>
<br><br>
<div id='mainav'align="center">
    <?php 
        if($ticket_list){
    ?>
    <h1>Total de Entradas Compradas: <?php echo $total_tickets ?></h1>
    <?php 
            foreach($ticket_list2 as $value){
    ?>            
        <li>
            <div class='planecard' style="width:350px; margin-bottom:20px">
            Pelicula: <?php echo $value['movie_name'] ?> <br>
            Cine: <?php echo $value['cinema_name'] ?> <br>
            Sala: <?php echo $value['room_name'] ?> <br>
            Fecha: <?php echo $value['date'] ?> <br>
            </div>
        </li>    
    <?php
            }
        }
        else echo "<br><br><br><br><br><br>"
    ?>
</div>