<?php
    namespace Controllers;

    use DAO\MovieShowDAO as MovieShowDAO;
    use DAO\RoomDAO as RoomDAO;
    Use Models\Room as Room;

    

    class RoomController
    {
        private $roomDAO;
        private $movieshowDAO;
        private $validateSession;

        public function __construct(){
            $this->roomDAO = new RoomDAO();
            $this->movieshowDAO = new MovieShowDAO;
        }

        public function ShowRoomsByCinemaView($id_cinema)
        {
            $roomList = $this->roomDAO->readRoomsByCinema($id_cinema);
            require_once(ADMIN_PATH."list_room.php");
        }

        public function ShowAddView($id_cinema)
        {
            require_once(ADMIN_PATH."add_room.php");
        }

        public function ShowEditView()
        {
            if($_POST)
            {
                $id = $_POST['idRoom'];
                $roomList = $this->roomDAO->GetAll();
                $room = $this->roomDAO->returnRoomById($id);
                require_once(ADMIN_PATH."edit_room.php");
            }
        }
    

        
    public function register(){
            
        $this->validateSession = ValidationController::getInstance();
        $this->validateSession->validateAdmin();
        $name = $_POST['name'];
        $capacity = $_POST['capacity'];
        $price = $_POST['price'];
        $id_cinema = $_POST['id_cinema'];


        $name = trim($name);
        if(empty($name))
        {
            $_SESSION['msg'] = 'El nombre de la sala de cine no puede estar vacio. Por favor intente nuevamente';
            require_once(ADMIN_PATH."add_room.php");
        }
        else{
            try{
                if(! $this->checkRoom($id_cinema, $name))
                {
                    $room = new Room(0,$name , $capacity, $price, $id_cinema);
                    $this->roomDAO->Add($room);
                    $_SESSION['msg'] = "Sala agregada correctamente";
                }
                else{
                    $_SESSION['msg'] = "La sala ya se encuentra registrada";
                    require_once(ADMIN_PATH."add_cinema.php");
                }
                
            }
            catch(\PDOException $ex){
                $message = "Exception";
                throw $ex;
            }
            finally{
                header('Location:'.FRONT_ROOT."Room/ShowRoomsByCinemaView/$id_cinema");
            }
        }
        
    }

    

    public function editRoom(){
        $this->validateSession = ValidationController::getInstance();
        $this->validateSession->validateAdmin();
        $name = $_POST["roomName"];
        $price = $_POST["roomPrice"];
        $capacity = $_POST["roomCapacity"];


        $name = trim($name);

        if(empty($name))
        {
            $_SESSION['msg'] = 'No se pueden colocar espacios vacios en el Nombre de la sala. Por favor intente nuevamente';
            $this->ShowEditView();
        }
        
        else if($_POST){
            $id = $_POST["idRoom"];
            $idCinema = $_POST["idCinema"];
            $Room = new Room(intval($id) , $name , $price, $capacity, intval($idCinema));
            $this->roomDAO->Edit($Room);
            $this->ShowRoomsByCinemaView($idCinema);
        }
        
    }
    
    public function removeRoom($id_room){
        
        
        $this->validateSession = ValidationController::getInstance();
        $this->validateSession->validateAdmin();
        
        
            if($_POST){
                $id = $_POST["id"];
                $id_cinema = $_POST['id_cinema'];

                if(!($this->movieshowDAO->checkMovieShowByRoom($id_room)))
                {
                    $this->roomDAO->Remove($id);
                    header('Location:'.FRONT_ROOT."Room/ShowRoomsByCinemaView/$id_cinema");
                }
                else
                {
                $_SESSION['msg'] = "No es posible eliminar, hay funciones en esta sala";
                header('Location:'.FRONT_ROOT."Room/ShowRoomsByCinemaView/$id_cinema");
                }       
            }
        }


    


    public function checkRoom($id_cinema,$name)
    {
        $roomList = $this->roomDAO->readRoomsByCinema($id_cinema);

        foreach($roomList as $room)
        {
            if($room->getName() == $name)
                return true;
        }
        return false;

    }
}


    ?>


        