<?php
    namespace Controllers;
    use DAO\CinemaDAO as CinemaDAO;
    Use Models\Cinema as Cinema;

    

    class CinemaController
    {
        private $cinemaDAO;
        
        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowMenuView($message = "")
        {
            require_once(VIEWS_PATH."menuCinema.php");
        }
/*         public function ShowCinemaView($message = "")
        {
            require_once(VIEWS_PATH."mainCinema.php");
        } */
        public function registerCinema($message = "")
        {
            require_once(VIEWS_PATH."auxi.php");
        }

        
        public function register(){
            
            
            $name = $_POST['name'];
            $address = $_POST['address'];
            $ticket_price = $_POST['ticket_price'];
            $total_capacity = $_POST['total_capacity'];

            $id = sizeof($this->cinemaDAO->GetAll());
           
            
            
            

            $newCinema = new Cinema();
            
            $newCinema->setId($id);
            $newCinema->setName($name);
            $newCinema->setAddress($address);
            $newCinema->setTicketPrice($ticket_price);
            $newCinema->setTotalCapacity($total_capacity);
            


            $newCinemaRepository = new CinemaDAO();
            $valid = $newCinemaRepository->Add($newCinema);
        
            if ($valid === 0){
                $message = "Cinema name already in use, try another";
                echo '<script language="javascript">alert("Cinema Name In Use");</script>';
            }else{
                $message = "Cinema added successfully";
                echo '<script language="javascript">alert("Your Cinema Has Been Registered Successfully");</script>';
            }
            $this->registerCinema($message);
        
        }


        public function showCinemas(){
            $cinemaList = array();
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH."cinemaManagment.php");
        }
    }
?>