<?php
    namespace Views;
    use DAO\CinemaDAO as CinemaDAO;
    Use Models\Cinema as Cinema;

    $cinemaDAO = new CinemaDAO();

    var_dump($cinemaDAO->GetAll());
    
   

    



    ?>