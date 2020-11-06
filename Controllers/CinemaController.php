<?php
    namespace Controllers;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieShowDAO as MovieShowDAO;
    Use Models\Cinema as Cinema;

    

    class CinemaController
    {
        private $cinemaDAO;
        private $movieshowDAO;
        private $validateSession;
        
        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
            $this->movieshowDAO = new MovieShowDAO();
        }

        public function ShowAdminHomeView($message = "")
        {
            require_once(ADMIN_PATH."list_movies.php");
        }

        public function ShowRemoveView($message = "")
        {
            if(isset($_SESSION['msg']))
            {
                echo '<script language="javascript">alert("'.$_SESSION['msg'].'");</script>';
                $_SESSION['msg'] = null;
            }
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
            if($_POST)
            {
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

            $this->validateSession = ValidationController::getInstance();
            $this->validateSession->validateAdmin();
            $name = $_POST['name'];
            $address = $_POST['address'];

            $name = trim($name);
            $address = trim($address);
            if(empty($name))
            {
                $_SESSION['msg'] = 'No se pueden colocar espacios vacios en el Nombre del cine. Por favor intente nuevamente';
                require_once(ADMIN_PATH."add_cinema.php");
            }else if(empty($address))
            {
                $_SESSION['msg'] = 'No se pueden colocar espacios vacios en la Direccion del cine. Por favor intente nuevamente';
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
                        $_SESSION['msg'] = "El cine que intenta añadir ya existe en el sistema. Por favor intente nuevamente";
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
            
            $this->validateSession = ValidationController::getInstance();
            $this->validateSession->validateAdmin();
            if(!($this->movieshowDAO->checkMovieShowByCinema($id_cinema)))
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

            $this->validateSession = ValidationController::getInstance();
            $this->validateSession->validateAdmin();
            $name = $_POST["name"];
            $address = $_POST["address"];

            $name = trim($name);
            $address = trim($address);

            if(empty($name))
            {
                $_SESSION['msg'] = 'No se pueden colocar espacios vacios en el Nombre del cine. Por favor intente nuevamente';
                $this->ShowEditView();
            }else if(empty($address))
            {
                $_SESSION['msg'] = 'No se pueden colocar espacios vacios en la Direccion del cine. Por favor intente nuevamente';
                $this->ShowEditView();
            }else if($_POST){
                $id = $_POST["id"];
                $Cinema = new Cinema(intval($id) , $name , $address);
                $this->cinemaDAO->Edit($Cinema);
                $this->ShowRemoveView();
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
