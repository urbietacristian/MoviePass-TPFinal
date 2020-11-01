<?php
require_once(VIEWS_PATH."navAdmin.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
<div >
    <div class="mainav" align='center' >
        <table class='table'>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Capacidad</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
            <?php
            foreach($roomList as $room){
            ?>
                <tr>
                    <td><?php echo $room->getName()?></td>
                    <td><?php echo $room->getPrice()?></td>
                    <td><?php echo $room->getCapacity()?></td>
                    <td>
                        <form  action="<?php echo FRONT_ROOT; echo "Room/ShowEditView?"; echo $room->getId()?>" method="POST">
                            <input type="hidden" value="<?php echo $room->getId(); ?>" name="id">
                            <button  type="submit" class="image">
                                <img src="<?php echo IMG_PATH."edit.png"; ?>">
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo FRONT_ROOT; echo "Room/removeRoom";?>" method="POST">
                            <input type="hidden" value="<?php echo $room->getId(); ?>" name="id">
                            <input type="hidden" value="<?php echo $id_cinema; ?>" name="id_cinema">
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
        <a href="<?php echo FRONT_ROOT; echo "Room/ShowAddView/"; echo $id_cinema; ?>">Agregar Sala</a>
    </div>
</div>
</main>