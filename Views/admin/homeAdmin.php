<?php
require_once(VIEWS_PATH."navAdmin.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
<div >
        <div >    
                <?php 
                $cinemaController->showCinemas();     
                ?>      
        </div>
</div>
</main>