<?php
    namespace Controllers;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieDAO as MovieDAO;
    use Controllers\MovieController as MovieController;
    use DAO\MovieShowDAO as MovieShowDAO;
    use DAO\TicketDAO as TicketDAO;
    use DAO\RoomDAO as RoomDAO;
    use DateTime;
    Use Models\Cinema as Cinema;
    use Models\MovieShow;
    use Models\Room;
    use Models\Ticket;
    use PDOException;

    class MovieShowController
    {
        private $movieShowDAO;
        private $movieDAO;
        private $cinemaDAO;
        private $roomDAO;    
        private $ticketDAO; 

        public function __construct()
        {
            $this->movieShowDAO = new MovieShowDAO();
            $this->movieDAO = new MovieDAO();
            $this->cinemaDAO = new CinemaDAO;
            $this->roomDAO = new RoomDAO;            
            $this->ticketDAO = new TicketDAO;      
        }

        /* SHOW FUNCTIONS */
        /*      ADMIN SHOW FUNCTIONS */


        public function ShowAddFunctionCinema($id_movie)
        {
            ValidationController::getInstance()->validateAdmin();

            $_SESSION['msg'] = null;
            $id_movie = $id_movie;
            $cinemaList =  $this->cinemaDAO->GetAll();
            $movie = $this->movieDAO->read($id_movie)['0'];
            require_once(ADMIN_PATH."add_movieshow_1.php");
        }

        public function ShowAddFunctionCinema2($id_movie)
        {
            ValidationController::getInstance()->validateAdmin();

            if($_POST)
            {
                $id_movie = $_POST['id_movie'];
                $id_cinema = $_POST['id_cinema'];
                $date = $_POST['date'];
                $cinema = $this->cinemaDAO->getCinemaByID($id_cinema)['0'];
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
                $time = $_POST['time'].':00';

                $date;
                $flag2 = $this->verifyDate($id_room, $date, $time, $id_movie);
                $flag1 = $this->movieShowDAO->verifyDifferentMovieOnRoom($id_cinema, $id_room, $date);
                if($flag2)
                {
                    if($flag1)
                    {
                    $movieController = new MovieController();
                    $this->register($id_movie,$id_cinema,$date,$id_room, $time);

                    header("location: ".FRONT_ROOT."Movie/ShowMovieDetail/$id_movie");
                    }
                    else 
                    {
                        $roomList = $this->roomDAO->readRoomsByCinema($id_cinema);
                        $movie = $this->movieDAO->read($id_movie)['0'];
                        $_SESSION['msg'] = "Ya existe una funcion de esta pelicula en otra sala de este cine hoy";
                        $_SESSION['endTime'] = null;
                        $cinema = $this->cinemaDAO->getCinemaByID($id_cinema)['0'];

                    require_once(ADMIN_PATH."add_movieshow_2.php");

                    }
                }
                else
                {
                    $roomList = $this->roomDAO->readRoomsByCinema($id_cinema);
                    $movie = $this->movieDAO->read($id_movie)['0'];
                    $_SESSION['msg'] = "La sala ya estará proyectando una película en ese horario. Volverá a estar disponible luego de las ".$_SESSION['endTime']." horas.";
                    $_SESSION['endTime'] = null;
                    $cinema = $this->cinemaDAO->getCinemaByID($id_cinema)['0'];

                    require_once(ADMIN_PATH."add_movieshow_2.php");
                }
            }
        }

        /*      USER SHOW FUNCTIONS */


        public function ShowMovieShowByCinema($id_movie, $id_cinema)
        {
            $roomList = $this->roomDAO->getRoomsByMovieAndCinema($id_cinema, $id_movie);

            if($roomList)
            {
                foreach($roomList as $room)
                {
                    $movieshowArray[$room->getId()] = $this->movieShowDAO->getMovieShowByRoom($room->getId(), $id_movie);
                }
                if(!isset($_SESSION['loggedUser']))
                {
                    require_once(GUEST_PATH."list_movieshow.php");
                }
                else
                {
                    require_once(USER_PATH."list_movieshow.php");
                }
            }
        }

        public function ShowFunctionsByMovie($id_movie, $cinema_name = false)
        {
            $displayList = $this->movieShowDAO->getDisplayableMovieShowByMovie($id_movie);
            $displayListAux = array();
            foreach($displayList as $display)
            {
                $movieshow = $this->movieShowDAO->getMovieShowById($display["id_movieshow"])['0'];
                $last_ticket = $this->ticketDAO->lastTicketNumber($movieshow->getId())['ticket_number']; // valor de la ultima ticket en bd
                if($last_ticket== null) //busco la ultima ticket vendida y retorno, si es null(todavia no hay tickets para esa funcion) es 0
                {
                    $last_ticket=0;
                }
                $capacity = intval($this->roomDAO->returnRoomById($movieshow->getIdRoom())->getCapacity());
                if( ($last_ticket) < $capacity ) //entra si no hay mas capacidad
                {
                    array_push($displayListAux, $display);
                }
                
            }
            $displayList = $displayListAux;
            $displayListbyCinema = array();
            if($cinema_name)
            {
                $cinema = $this->cinemaDAO->read($cinema_name)['0'];
                foreach($displayList as $display)
                {
                    if($display['cinema_name'] == $cinema_name)
                        array_push($displayListbyCinema, $display);
                }
                $displayList = $displayListbyCinema;
            }
            
            if(!$displayList)
            {
                $_SESSION['msg'] = "No quedan entradas en ninguna funcion";   
                if($cinema_name)
                    header("location: ".FRONT_ROOT."Movie/ShowMoviesByCinema/".$cinema->getId()."");
                else 
                    header("location: ".FRONT_ROOT."Movie/Movie/showActiveMovies");
            }
            else
            {
            $movie = $this->movieDAO->read($id_movie)['0'];
            
            if(!isset($_SESSION['loggedUser']))
                require_once(GUEST_PATH."detail_movie.php");
            else
                require_once(USER_PATH."buy_movie.php");
            }
        }

        /* FUNCTIONAL FUNCTIONS */

        public function register($id_movie,$id_cinema,$date, $id_room, $schedule)
        {
            ValidationController::getInstance()->validateAdmin();

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

        public function movieshowByCurrentDate()
        {
            $movieshowList = $this->movieShowDAO->GetAll();
            $newMovieshowList = array();
            foreach($movieshowList as $movieshow)
            {
                if(date("Y-m-d") <= $movieshow->getDate())
                {
                    array_push($newMovieshowList, $movieshow);
                }
            }
        }


        public function dateTimeToString($movieshow)
        {
            $days = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            $movieshowDate = date_create($movieshow->getDate());
            $weekDay = date_format($movieshowDate, "w");
            $date = date_format($movieshowDate, "d");
            $month = date_format($movieshowDate, "n");
            $time = new DateTime($movieshow->getSchedule());
            $time = date_format($time, "G:i");
            return $movieshow_datetime = $days[$weekDay]." ".$date." de ".$months[$month-1]. " a las ".$time ;
        }

        public function removeMovieShow()
        {
            ValidationController::getInstance()->validateAdmin();

            if($_POST)
            {
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

        public function verifyDate($id_room, $date, $time, $id_movie)
        {
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

                        $_SESSION['endTime'] = $endTime->format('H:i');

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
