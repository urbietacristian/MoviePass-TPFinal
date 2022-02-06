<?php
require_once(VIEWS_PATH."navAdmin.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
<div >
    <div class="mainav" align='center'>
        <br><br>
        <a class="button" href="<?php echo FRONT_ROOT; echo "Cinema/ShowAddView"; ?>">Agregar Cine</a>
        <br><br><br>

        <table class='table'>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Ver Salas</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
            <?php
            foreach($cinemaList as $cinema){
            ?>
                <tr>
                    <td><?php echo $cinema->getName()?></td>
                    <td><?php echo $cinema->getAddress()?></td>
                    <td>
                        <a href="<?php echo FRONT_ROOT; echo "Room/ShowRoomsByCinemaView/"; echo $cinema->getId(); ?>">Lista de Salas</a>                    
                    </td>
                    <td>
                        <form  action="<?php echo FRONT_ROOT; echo "Cinema/ShowEditView?"; echo $cinema->getId()?>" method="POST">
                            <input type="hidden" value="<?php echo $cinema->getId(); ?>" name="id">
                            <button  type="submit" class="image">
                                <img src="<?php echo IMG_PATH."edit.png"; ?>">
                            </button>
                        </form>
                    </td>
                    <td >
                        <form action="<?php echo FRONT_ROOT; echo "Cinema/removeCinema/"; echo $cinema->getId();?>" method="POST">
                            <input type="hidden" value="<?php echo $cinema->getId(); ?>" name="id"> 
                            <input type="hidden" value="<?php echo $cinema->getName(); ?>" name="name">
                            
                            <button type="submit" class="image">
                                <img src="<?php echo IMG_PATH."remove.png"; ?>">
                            </button>
                        </form>
                    </td>                    
                </tr>
            <?php }?>
            </tbody>
        </table>
        <br>
        
    </div>
</div>
</main>