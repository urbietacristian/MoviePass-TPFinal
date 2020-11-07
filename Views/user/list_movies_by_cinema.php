<?php
require_once(VIEWS_PATH."navUser.php");
?>
<main class="d-flex align-items-center justify-content-center height-100" >
    <div id="mainav">
        <?php        
        foreach($movie_list as $movie){
        ?>                        
        <li>            
            <div class='card'>
                <a href='<?php echo FRONT_ROOT; ?>MovieShow/ShowMovieShowDetail/<?php echo $movie->getIdApi()?>'>
                <div >
                    <img src='http://image.tmdb.org/t/p/w300<?php echo $movie->getImage()?>'>
                </div>
                <div class='title' style='display:block;text-overflow: ellipsis;width: 165px;overflow: hidden; white-space: nowrap'>
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
