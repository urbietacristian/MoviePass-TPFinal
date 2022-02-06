<?php
    namespace Controllers;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieShowDAO as MovieShowDAO;
    use DAO\RoomDAO as RoomDAO;
    Use Models\Cinema as Cinema;
    

    class CinemaController
    {
        private $cinemaDAO;
        private $movieshowDAO;
        private $roomDAO;
        
        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
            $this->movieshowDAO = new MovieShowDAO();
            $this->roomDAO = new RoomDAO();
        }

        public function ShowAdminHomeView($message = "")
        {
            require_once(ADMIN_PATH."list_movies.php");
        }

        public function ShowRemoveView($message = "")
        {
            ValidationController::getInstance()->validateAdmin();

            $cinemaDAO = new CinemaDAO();
            $cinemaList = $cinemaDAO->GetAll();
            if(!$cinemaList)
            $cinemaList = [];
            require_once(ADMIN_PATH."list_cinema.php");
        }

        public function ShowAddView($message = "")
        {
            ValidationController::getInstance()->validateAdmin();

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

        public function ShowActiveCinemas()
        {
            $cinema_list = $this->cinemaDAO->getCinemasIfMovieshow();
            if(!isset($_SESSION['loggedUser']))
            {
                require_once(GUEST_PATH."list_active_cinemas.php");
            }
            else
            {
                require_once(USER_PATH."list_active_cinemas.php");
            }
        }

        public function ShowEditView()
        {
            ValidationController::getInstance()->validateAdmin();

            if($_POST)
            {
                $id = $_POST['id'];
                $cinemaList = $this->cinemaDAO->GetAll();
                $Cinema = $this->cinemaDAO->returnCinemaById($id);
                require_once(ADMIN_PATH."edit_cinema.php");
            }
        }

        public function register()
        {
            ValidationController::getInstance()->validateAdmin();

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
                        $this->ShowRemoveView();
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
                    $this->ShowRemoveView();
                }
            }            
        }

        public function removeCinema($id_cinema)
        {            
            ValidationController::getInstance()->validateAdmin();

            if($this->movieshowDAO->checkMovieShowByCinema($id_cinema) == false)
            {
                
                if($_POST){
                    
                    $name = $_POST["name"];
                    $this->cinemaDAO->Remove($name);
                    $_SESSION['msg'] = "Eliminado con exito";
                    $this->ShowRemoveView();
                }
            }
            else
            {
                $_SESSION['msg'] = "No es posible eliminar, hay funciones en este cine";
                $this->ShowRemoveView();
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

        public function editCinema()
        {
            ValidationController::getInstance()->validateAdmin();

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
    }
?>
