<?php
    namespace Controllers;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieDAO as MovieDAO;
    use Controllers\MovieController as MovieController;
    use DAO\MovieShowDAO;
    use DAO\RoomDAO as RoomDAO;
    use DateTime;
    Use Models\Cinema as Cinema;
    use Models\MovieShow;
    use Models\Room;
    use PDOException;

class MovieShowController
    {
        private $movieShowDAO;
        private $movieDAO;
        private $cinemaDAO;
        private $roomDAO;
        private $validateSession;
        
        
        public function __construct(){
            $this->movieShowDAO = new MovieShowDAO();
            $this->movieDAO = new MovieDAO();
            $this->cinemaDAO = new CinemaDAO;
            $this->roomDAO = new RoomDAO;        
            
        }
        

            
        public function ShowMovieShowByCinema($id_movie, $id_cinema)
        {
            ValidationController::getInstance()->validateUser();

            $roomList = $this->roomDAO->getRoomsByMovieAndCinema($id_cinema, $id_movie);

            if($roomList)
            {   
                foreach($roomList as $room)
                {
                    $movieshowArray[$room->getId()] = $this->movieShowDAO->getMovieShowByRoom($room->getId(), $id_movie) ;
                }
                require_once(USER_PATH."list_movieshow.php");
            }
            
            
        }

        public function ShowAddFunctionCinema($id_movie)
        {
            $_SESSION['msg'] = null;
            $this->validateSession = ValidationController::getInstance();
            $this->validateSession->validateAdmin();   
            $id_movie = $id_movie;
            $cinemaList =  $this->cinemaDAO->GetAll();
            $movie = $this->movieDAO->read($id_movie)['0'];
            require_once(ADMIN_PATH."add_movieshow_1.php");
        }

        public function ShowAddFunctionCinema2($id_movie)
        {
            $this->validateSession = ValidationController::getInstance();
            $this->validateSession->validateAdmin();
            if($_POST)
            {
                $id_movie = $_POST['id_movie'];
                $id_cinema = $_POST['id_cinema'];
                $date = $_POST['date'];
                $flag = $this->movieShowDAO->verifyMovieOnCinema($id_cinema, $id_movie, $date);
                if($flag)
                {
                    $roomList = $this->roomDAO->readRoomsByCinema($id_cinema);
                    $movie = $this->movieDAO->read($id_movie)['0'];
                    require_once(ADMIN_PATH."add_movieshow_2.php");
                }
                else
                {
                    $roomList = $this->roomDAO->readRoomsByCinema($id_cinema);
                    $movie = $this->movieDAO->read($id_movie)['0'];
                    $cinemaList =  $this->cinemaDAO->GetAll();
                    $_SESSION['msg'] = "Ya existe una funcion de la pelicula en otro cine este dia";
                    require_once(ADMIN_PATH."add_movieshow_1.php");
                }
            }
        }

        public function ShowAddFunctionCinemaEnd($id_movie)
        {
            ValidationController::getInstance()->validateAdmin();
            

            if($_POST)
            {
                $id_movie = $_POST['id_movie'];
                $id_cinema = $_POST['id_cinema'];
                $date = $_POST['date'];
                $id_room = $_POST['id_room'];
                $time = $_POST['time'];
        
                $date;
                $flag2 = $this->verifyDate($id_room, $date, $time, $id_movie);
                if($flag2)
                {
                    $movieController = new MovieController();
                    $this->register($id_movie,$id_cinema,$date,$id_room, $time);
                    header("location: ".FRONT_ROOT."Movie/ShowMovieDetail/$id_movie");
                   
                }
                else
                {
                    $roomList = $this->roomDAO->readRoomsByCinema($id_cinema);
                    $movie = $this->movieDAO->read($id_movie)['0'];
                    $_SESSION['msg'] = "Ya existe una funcion en ese horario";
                    require_once(ADMIN_PATH."add_movieshow_2.php");
                }
            }
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
                $cinemaList = $this->movieShowDAO->GetAll();
                $Cinema = $this->cinemaDAO->returnCinemaById($id);
                require_once(ADMIN_PATH."edit_cinema.php");

            }
            
        }


        public function ShowFunctionsByMovie($id_movie)
        {
            ValidationController::getInstance()->validateUser();
            $displayList = $this->movieShowDAO->getDisplayableMovieShowByMovie($id_movie);
            $movie = $this->movieDAO->read($id_movie)['0'];

            require_once(USER_PATH."buy_movie.php");
            


        }

        public function registerCinema($message = "")
        {
            require_once(VIEWS_PATH."auxi.php");
        }









        
        public function register($id_movie,$id_cinema,$date, $id_room, $schedule){
        
            $this->validateSession = ValidationController::getInstance();
            $this->validateSession->validateAdmin();
            $flag = $this->movieShowDAO->verifyMovieOnCinema($id_cinema , $id_movie , $date);

                if($flag == true)
                {
                    try
                    {
                        $movieshow = new MovieShow(null,$id_room , $id_movie ,$date, $schedule);
                        $this->movieShowDAO->Add($movieshow);
                        $_SESSION['msg'] = "Funcion agregada correctamente";
                    }
                    catch(PDOException $ex)
                    {
                        $message = "Exception";
                        throw $ex;

                    }

                }
                else
                {
                    $_SESSION['msg'] = "No se puede agregar funcion en ese horario o sala";
                }

        
        }

        public function removeMovieShow(){
            
            $this->validateSession = ValidationController::getInstance();
            $this->validateSession->validateAdmin();
   
           if($_POST){
                    
                    $id_room = $_POST["id_room"];
                    $id_movieshow = $_POST["id_movieshow"];
                    $this->movieShowDAO->Remove($id_movieshow, $id_room);
                    $movieController = new MovieController();
                    $_SESSION['msg'] = "Eliminado con exito";
                    $movieController->ShowMovieDetail($_POST["id_cinema"]);
            }
    
        }





        public function getMovieById($id_movie)
        {
            $movieList = $this->movieDAO->getAllMovies();

            foreach($movieList as $movie)
            {
                if($movie->getIdApi() == $id_movie)
                {
                    return $movie;
                }
            }
            return false;
        }

        

        public function verifyDate($id_room, $date, $time, $id_movie){

            try
            {
                $movieshowList= $this->movieShowDAO->GetAll();
            }
            catch(PDOException $ex)
            {
                $_SESSION['Error']="Error al validar horario";
            }
            $movie= $this->getMovieById($id_movie);

            $newStartTime=date_create($time); 

            $movie_duration = $movie->getDuration();

            $newEndTime = date_create($time);
            date_add($newEndTime,date_interval_create_from_date_string($movie_duration." minutes"));

            
            if($movieshowList == null)
            {
                return true;
            }
            else
            {
                
                foreach($movieshowList as $movieshow)
                {
                    if($movieshow->getidRoom() == $id_room && $movieshow->getDate() == $date)
                    {
                        $startTime = date_create($movieshow->getSchedule());
                        $movieshowFilm = $this->movieDAO->read($movieshow->getidMovie())['0'];
                        $endTime = date_create($movieshow->getSchedule());
                        $duration = $movieshowFilm->getDuration() + 15;
                        date_add($endTime,date_interval_create_from_date_string($duration." minutes"));
                        date_format($endTime,"G:i");

                        

                        if(($newStartTime > $startTime && $newStartTime <$endTime) | ($newEndTime > $startTime && $newEndTime < $endTime))  //verifica q le pelicula no se pise con otras funciones
					    {
					    	return false;
				    	}
                    }
                }

                return true;
            }

            
        }



}
?>
