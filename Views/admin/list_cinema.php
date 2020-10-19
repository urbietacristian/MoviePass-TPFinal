<?php
require_once(VIEWS_PATH."navAdmin.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
<div >
    <div >
        <div >
            <?php
            use DAO\CinemaDAO;
            $cinemaDAO = new CinemaDAO();
            $cinemaList = $cinemaDAO->GetAll();
            $id = 0;
                        foreach($cinemaList as $cinema){
                        
                        echo "<div>";
                            
                              
                                echo "<div class='data'>
                                        Nombre: ".$cinema->getName()."
                                        </div>
                                        "
                                        ;
                                echo "<div class='data'>                                        
                                        Direccion: ".$cinema->getAddress()."
                                        </div>";
                                echo "<div class='data'>
                                        Precio de entrada: ".$cinema->getTicketPrice()."
                                        </div>";
                                echo "<div class='data'>
                                        Capacidad Maxima: ".$cinema->getTotalCapacity()."
                                        </div>";
                                  
                                /* echo "<div class='title'>
                                        ".$cinema->getShow()."
                                        </div>"; */
                            echo "</div>
                                </div>";?>
                                
                                <form action="<?php echo FRONT_ROOT; echo "Cinema/ShowEditView";?>" method="POST">
                                    <input type="hidden" value="<?php echo $cinema->getId(); ?>" name="id">
                                    <button type="submit" class="image">
                                        <img src="<?php echo IMG_PATH."edit.png"; ?>">
                                    </button>
                                </form>
                                <form action="<?php echo FRONT_ROOT; echo "Cinema/removeCinema";?>" method="POST">
                                    <input type="hidden" value="<?php echo $cinema->getId(); ?>" name="id">
                                    <button type="submit" class="image">
                                    <img src="<?php echo IMG_PATH."remove.png"; ?>">
                                    </button>
                                </form>
                        
                            <?php
                        echo "<br></div>";
                        $id++;
                        }
            ?>
        </div>
        </div>
        </div>
    </div>
</div>
</main>