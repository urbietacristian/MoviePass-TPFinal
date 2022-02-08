<?php
  require_once(VIEWS_PATH."navUser.php");
?>

<br>
<div id='mainav'align="center">
    <?php 
        if($ticket_list){
    ?>
    <h1>Total de Entradas Compradas: <?php echo $total_tickets ?></h1>
    <div class = "genre-list">
    <li class="active"><a href="<?php echo FRONT_ROOT; ?>Purchase/showMyTicketsView">Ordenar por Película</a></li>
    <li class="active"><a href="<?php echo FRONT_ROOT; ?>Purchase/showMyTicketsView/1">Ordenar por Fecha</a></li>
    </div>    
    <ul class="carta-grid">
    <?php 
            foreach($ticket_list2 as $value){
    ?>            
        <li class='ticket'>
            <div>
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
    </ul>
</div>