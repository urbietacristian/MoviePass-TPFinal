<?php
require_once(VIEWS_PATH."navUser.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
    <div id="mainav">
        <?php  

        foreach($roomList as $room){
        ?> 
        <h1><?php echo $room->getName(); ?></h1>                       
        <?php foreach($movieshowArray[$room->getId()] as $movieshow) {;?>
                <li>            
                    <div class='card'>
                        <div>
                            <?php echo$movieshow->getDate();?>
                        </div>
                        </a>
                    </div>
                </li>
        <?php
        }}
        ?>
    </div>
</main>
