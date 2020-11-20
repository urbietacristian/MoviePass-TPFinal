<?php
    namespace Controllers;
    use DAO\MovieDAO as MovieDAO;
    use DAO\MovieShowDAO as MovieShowDAO;
    use DAO\GenreDAO as GenreDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Movie as Movie;
    use Models\Genre as Genre;
    use Models\Cinema as Cinema;
    use Controllers\ValidationController as ValidationController;

    class MovieController
    {
        private $movieDAO;
        private $genreDAO;
        private $cinemaDAO;
        private $movieshowDAO;

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->movieshowDAO = new MovieShowDAO();
        }

        public function ShowMovieDetail($id_movie)
        {            
            ValidationController::getInstance()->validateAdmin();

            $movie = $this->movieDAO->read($id_movie)['0'];
            $displayList = $this->movieshowDAO->getDisplayableMovieShowByMovie($id_movie);
            
            require_once(ADMIN_PATH."detail_movie.php");
        }

        public function UpdateMovies()
        {
            ValidationController::getInstance()->validateAdmin();
            
            $this->movieDAO->updateMovies();
            $this->showMovies();
        }

        public function showMovies($id = "")
        {              
            ValidationController::getInstance()->validateAdmin();

            if(!($id == "")){
                $movie_list = $this->getMoviesByGenre($id);
            }
            else{
                $movie_list = $this->movieDAO->getAllMovies();
            }

            $genre_list = $this->getActiveGenres();

            require_once(ADMIN_PATH."list_movies.php");
        }

        public function ShowMoviesByCinema($id_cinema)
        {

            $movie_list = $this->movieDAO->getMoviesByCinema($id_cinema);
            $cinema = $this->cinemaDAO->getCinemaByID($id_cinema)['0'];

            if($movie_list)
            {     
                if(!isset($_SESSION['loggedUser']))
                {
                    require_once(GUEST_PATH."list_movies_by_cinema.php");
                }
                else
                {
                    require_once(USER_PATH."list_movies_by_cinema.php");
                }
            }
            else
            {
                $_SESSION['msg'] = 'No hay funciones en este cine'; 
                $cinema_list = $this->cinemaDAO->getCinemasIfMovieshow();
                if(!isset($_SESSION['loggedUser']))
                {
                    require_once(GUEST_PATH."list_active_cinemas.php");
                }
                else
                {
                    require_once(USER_PATH."list_active_cinemas.php");;
                }
            }
            
        }

        public function showActiveMovies($id = "")
        {
            
            if($id == "fecha"){
                $movie_list = $this->movieDAO->getMoviesOnFunctionsByDate();

            }
            else if(!($id == ''))
            {
                $movie_list = $this->getActiveMoviesByGenre($id);
                
            }
            else{
                $movie_list = $this->movieDAO->getMoviesOnFunctions();
            }

            $genre_list = $this->genreDAO->getAllGenres();           

            if(!isset($_SESSION['loggedUser']))
            {
                require_once(GUEST_PATH.'home_guest.php');
            }
            else
            {
                require_once(USER_PATH.'homeUser.php');
            }
        }

        public function getMoviesByGenre($id)
        {
            $genre_movie_list = array();
            $movie_list = $this->movieDAO->getAllMovies();

            foreach($movie_list as $movie)
            {
                if(in_array($id, $movie->getGenreIds()))
                {
                    array_push($genre_movie_list, $movie);
                }
            }

            return $genre_movie_list;
        }

        public function getActiveMoviesByGenre($id)
        {
            $genre_movie_list = array();
            $movie_list = $this->movieDAO->getMoviesOnFunctions();

            foreach($movie_list as $movie)
            {
                if(in_array($id, $movie->getGenreIds()))
                {
                    array_push($genre_movie_list, $movie);
                }
            }

            return $genre_movie_list;
        }

        public function getActiveGenres()
        {
            $complete_genre_list = $this->genreDAO->getAllGenres();
            $movies_now_playing = $this->movieDAO->getAllMovies();
            $active_genres_ids = array();
            foreach($movies_now_playing as $movie)
            {
                foreach($movie->getGenreIds() as $genre_id)
                {
                    
                    array_push($active_genres_ids, $genre_id);
                }                
            }
            $active_genres_ids = array_unique($active_genres_ids);
            $active_genres = array();
            
            foreach($active_genres_ids as $value)
            {
                if($value)
                {
                    array_push($active_genres, $this->genreDAO->getGenreById($value));
                }
                
            }
            return $active_genres;
        }
    }
?>
