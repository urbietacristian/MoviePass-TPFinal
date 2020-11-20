<?php
require_once(VIEWS_PATH."navUser.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
    <div id="mainav">
    <h1>Películas en <?php echo $cinema->getName()?></h1>
        <?php        
        foreach($movie_list as $movie){
        ?>                        
        <li>            
            <div class='card'>
                <a href='<?php echo FRONT_ROOT; ?>MovieShow/ShowFunctionsByMovie?id_movie=<?php echo $movie->getIdApi()?>&cinema_name=<?php echo $cinema->getName()?>'>
                <div >
                    <img src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage()?>'>
                </div>
                <div class='title' style='display:block;text-overflow: ellipsis;width: 270px;overflow: hidden; white-space: nowrap'>
                    <p><?php echo $movie->getName()?></p>
                </div>
                </a>
            </div>
        </li>
        <?php
        }
        ?>
    </div>
</main>
