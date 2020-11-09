<?php
require_once(VIEWS_PATH."navUser.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
    <div >
        <div class="mainav" align='center'>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Ver Funciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($cinema_list as $cinema){
                    ?>
                    <tr>
                        <td><?php echo $cinema->getName()?></td>
                        <td><?php echo $cinema->getAddress()?></td>
                        <td>
                            <a href="<?php echo FRONT_ROOT; echo "Movie/ShowMoviesByCinema/"; echo $cinema->getId(); ?>">Funciones en <?php echo $cinema->getName()?></a>                    
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>