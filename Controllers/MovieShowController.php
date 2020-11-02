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
    use PDOException;

class MovieShowController
    {
        private $movieShowDAO;
        private $movieDAO;
        
        
        public function __construct(){
            $this->movieShowDAO = new MovieShowDAO();
            $this->movieDAO = new MovieDAO();
        }

        public function ShowAddFunctionCinema($id_movie)
        {
            $id_movie = $id_movie;
            $cinemaDAO = new CinemaDAO();
            $cinemaList =  $cinemaDAO->GetAll();
            $movieDAO = new MovieDAO();
            $movie = $movieDAO->read($id_movie);

            $movieshowList = $this->movieShowDAO->GetAll();
            foreach($movieshowList as $movieshow)
            var_dump($movieshow->getSchedule());
            require_once(ADMIN_PATH."add_movieshow_1.php");
        }

        public function ShowAddFunctionCinema2($id_movie)
        {
            

            if($_POST)
            {
                $id_movie = $_POST['id_movie'];
                $id_cinema = $_POST['id_cinema'];
                $date = $_POST['date'];
                $flag = $this->movieShowDAO->verifyMovieOnCinema($id_cinema, $id_movie, $date);
                if($flag)
                {
                    $roomDAO = new RoomDAO();
                    $roomList = $roomDAO->readRoomsByCinema($id_cinema);
                    $movieDAO = new MovieDAO();
                    $movie = $movieDAO->read($id_movie);
                    require_once(ADMIN_PATH."add_movieshow_2.php");
                }
                else
                {
                    $roomDAO = new RoomDAO();
                    $roomList = $roomDAO->readRoomsByCinema($id_cinema);
                    $movieDAO = new MovieDAO();   
                    $movie = $movieDAO->read($id_movie);
                    $_SESSION['msg'] = "Ya existe una funcion de la pelicula en otro cine este dia";
                    require_once(ADMIN_PATH."add_movieshow_1.php");
                }
            }
        }

        public function ShowAddFunctionCinemaEnd($id_movie)
        {


            if($_POST)
            {
                $id_movie = $_POST['id_movie'];
                $id_cinema = $_POST['id_cinema'];
                $date = $_POST['date'];
                $id_room = $_POST['id_room'];
                $time = $_POST['time'];
        
                $date;
                var_dump($date);
                $flag2 = $this->verifyDate($id_room, $date, $time, $id_movie);
                if($flag2)
                {
                    $movieController = new MovieController();
                    $this->register($id_movie,$id_cinema,$date,$id_room, $time);
                   // header("location: ".FRONT_ROOT."Movie/ShowMovieDetail/$id_movie");
                   $movieController->ShowMovieDetail($id_movie);
                }
                else
                {
                    $roomDAO = new RoomDAO();
                    $roomList = $roomDAO->readRoomsByCinema($id_cinema);
                    $movieDAO = new MovieDAO();
                    $movie = $movieDAO->read($id_movie);
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

        public function registerCinema($message = "")
        {
            require_once(VIEWS_PATH."auxi.php");
        }

        
        // public function register(){
            
            
        //     $name = $_POST['name'];
        //     $address = $_POST['address'];
        //     $ticket_price = $_POST['ticket_price'];
        //     $total_capacity = $_POST['total_capacity'];

        //     $id = sizeof($this->cinemaDAO->GetAll());

        //     $newCinema = new Cinema();
            
        //     $newCinema->setId($id);
        //     $newCinema->setName($name);
        //     $newCinema->setAddress($address);
        //     $newCinema->setTicketPrice($ticket_price);
        //     $newCinema->setTotalCapacity($total_capacity);
            


        //     $newCinemaRepository = new CinemaDAO();
        //     $valid = $newCinemaRepository->Add($newCinema);
        
        //     if ($valid === 0){
        //         $message = "Cinema name already in use, try another";
        //         echo '<script language="javascript">alert("Cinema Name In Use");</script>';
        //     }else{
        //         $message = "Cinema added successfully";
        //         echo '<script language="javascript">alert("Your Cinema Has Been Registered Successfully");</script>';
        //     }
        //     $this->ShowAdminHomeView($message);
        
        // }


        
        public function register($id_movie,$id_cinema,$date, $id_room, $schedule){
            
    

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



        public function getMovieById($id_movie)
        {
            $movieDAO = new MovieDAO();
            $movieList = $movieDAO->getAllMovies();

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
                        $movieshowFilm = $this->movieDAO->read($movieshow->getidMovie());
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
