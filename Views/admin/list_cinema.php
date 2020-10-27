<?php
require_once(VIEWS_PATH."navAdmin.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
<div >
    <div >
        <div >
            <?php
            $cinemaList = $cinemaDAO->GetAll();
            foreach($cinemaList as $cinema){
                    echo "<div class='card'>";
                        
                            echo "<div class='data'>
                                    Nombre: ".$cinema->getName()."
                                    </div>
                                    "
                                    ;
                            echo "<div class='data'>                                        
                                    Direccion: ".$cinema->getAddress()."
                                    </div>";
                            echo "<div class='data'>
                                    Capacidad Maxima: ".$cinema->getTotalCapacity()."
                                    </div>";
                        
                        echo "</div>";?>
                            
                            <form action="<?php echo FRONT_ROOT; echo "Cinema/ShowEditView";?>" method="POST">
                                <input type="hidden" value="<?php echo $cinema->getId(); ?>" name="id">
                                <button type="submit" class="image">
                                    <img src="<?php echo IMG_PATH."edit.png"; ?>">
                                </button>
                            </form>
                            <form action="<?php echo FRONT_ROOT; echo "Cinema/removeCinema";?>" method="POST">
                                <input type="hidden" value="<?php echo $cinema->getName(); ?>" name="name">
                                <button type="submit" class="image">
                                <img src="<?php echo IMG_PATH."remove.png"; ?>">
                                </button>
                            </form>
                    
                        <?php
                    echo "</div><br></div>";
                    }
            ?>
        </div>
    </div>
</div>
</main>