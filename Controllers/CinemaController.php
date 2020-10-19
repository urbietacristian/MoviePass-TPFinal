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

        public function ShowAdminHomeView($message = "")
        {
            require_once(ADMIN_PATH."homeAdmin.php");
        }

        public function ShowRemoveView($message = "")
        {
            require_once(ADMIN_PATH."list_cinema.php");
        }

        public function ShowAddView($message = "")
        {
            require_once(ADMIN_PATH."add_cinema.php");
        }

        public function ShowHomeView($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function ShowEditView()
        {
            if($_POST){
                $id = $_POST['id'];
                $cinemaList = $this->cinemaDAO->GetAll();
                $Cinema = $this->cinemaDAO->returnCinemaById($id);
                require_once(ADMIN_PATH."edit_cinema.php");

            }
            
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
            $this->ShowAdminHomeView($message);
        
        }

        public function removeCinema(){
            
            if($_POST){
                
                $id = number_format($_POST["id"]);
                $this->cinemaDAO->Remove($id);
                $this->ShowRemoveView("Eliminado con exito");
            }


        }


        public function editCinema(){

            $Cinema = new Cinema();



            if($_POST){
                $id = $_POST["id"];
                $Cinema->setId( intval($id));
                $Cinema->setName($_POST["name"]);
                $Cinema->setAddress($_POST["address"]);
                $Cinema->setTicketPrice($_POST["ticket_price"]);
                $Cinema->setTotalCapacity($_POST["total_capacity"]);
                $this->cinemaDAO->Edit($Cinema);
                $this->ShowAdminHomeView();


            }

            
                
        }


        public function showCinemas(){
            $cinemaList = array();
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH."cinemaManagment.php");
        }
    }
?>