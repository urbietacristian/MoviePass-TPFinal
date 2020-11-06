<?php
    namespace Controllers;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieShowDAO as MovieShowDAO;
    Use Models\Cinema as Cinema;

    

    class CinemaController
    {
        private $cinemaDAO;
        private $movieshowDAO;
        
        public function __construct(){
            $this->cinema = new CinemaDAO();
            $this->movieshowDAO = new MovieShowDAO();
        }

        public function ShowAdminHomeView($message = "")
        {
            require_once(ADMIN_PATH."list_movies.php");
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

        public function ShowUserHomeView($message = "")
        {
            require_once(USER_PATH."homeUser.php");
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

        public function registerCinema($message = "")
        {
            require_once(VIEWS_PATH."auxi.php");
        }




        
        public function register(){
            
            $name = $_POST['name'];
            $address = $_POST['address'];

            $name = trim($name);
            if(empty($name))
            {
                $_SESSION['msg'] = 'no bro, esta bacio';
                require_once(ADMIN_PATH."add_cinema.php");
            }
            else{
                try{
                    if(! $this->checkCinema($_POST['name']))
                    {
                        $cinema = new Cinema(0,$_POST['name'] , $_POST['address']);
                        $this->cinemaDAO->Add($cinema);
                        $_SESSION['msg'] = "Cine agregado correctamente";
                    }
                    else{
                        $_SESSION['msg'] = "el cine ya se encuentra registrado";
                        require_once(ADMIN_PATH."add_cinema.php");
                    }
                    
                }
                catch(\PDOException $ex){
                    $message = "Exception";
                    throw $ex;
                }
                finally{
                    require_once(ADMIN_PATH."homeAdmin.php");
                }
            }
            
        }

        public function removeCinema($id_cinema){
            
            if($this->movieshowDAO->checkMovieShowByCinema($id_cinema))
            {
                if($_POST){
                    
                    $name = $_POST["name"];
                    $this->cinemaDAO->Remove($name);
                    $this->ShowRemoveView("Eliminado con exito");
                }
            }


        }

        public function checkCinema($name)
        {
            $cinema = $this->cinemaDAO->read($name);

            if($cinema)
                return true;
            else
                false;
            
        }


        public function editCinema(){

            if($_POST){
                $id = $_POST["id"];
                $Cinema = new Cinema(intval($id) , $_POST["name"] , $_POST["address"] ,$_POST["total_capacity"]);
                $this->cinemaDAO->Edit($Cinema);
                $this->ShowAdminHomeView();
            }   
        }


        // public function showCinemas()
        // {
        // $cinemaList = $this->cinemaDAO->GetAll();
        
        // foreach($cinemaList as $cinema){
        // echo "<div>";
            
        //         echo "<div>
        //                 Nombre: ".$cinema->getName()."
        //                 </div>
        //                 "
        //                 ;
        //         echo "<div>                                        
        //                 Direccion: ".$cinema->getAddress()."
        //                 </div>";
        //         echo "<div>
        //                 Capacidad Maxima: ".$cinema->getTotalCapacity()."
        //                 </div>";

        //     echo "</div> <br>";
        //     }
    
        //  }




}
?>
