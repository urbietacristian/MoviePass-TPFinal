<?php
require_once(VIEWS_PATH."navAdmin.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
<div >
    <div class="mainav" >
        <table class='table'>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Capacidad</th>
                    <th></th>
                    <th></th>
                    <th>Agregar Sala</th>
                </tr>
            </thead>

            <tbody>
            <?php
            foreach($cinemaList as $cinema){
            ?>
                <tr>
                    <td><?php echo $cinema->getName()?></td>
                    <td><?php echo $cinema->getAddress()?></td>
                    <td><?php echo $cinema->getTotalCapacity()?></td>
                    <td><form  action="<?php echo FRONT_ROOT; echo "Cinema/ShowEditView?"; echo $cinema->getName()?>" method="POST">
                                <input type="hidden" value="<?php echo $cinema->getId(); ?>" name="id">
                                <button  type="submit" class="image">
                                <img src="<?php echo IMG_PATH."edit.png"; ?>">
                                </button>
                        </form>
                    </td>
                    <td >
                        <form action="<?php echo FRONT_ROOT; echo "Cinema/Remove";?>" method="POST">
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
    </div>
</div>
</main>