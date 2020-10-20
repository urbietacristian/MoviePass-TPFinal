<?php
    namespace Controllers;
    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;
    use Models\Movie as Movie;
    use Models\Genre as Genre;

    class BillboardController
    {
        private $movieDAO;
        private $genreDAO;

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
        }

        // public function showBillboardView($message = "")
        // {
        //     require_once(USER_PATH."billboard.php");
        // }

        public function showMovies($id = "")
        {
            
            if(!($id == "")){
                $movie_list = $this->getMoviesByGenre($id);
            }
            else{
                $movie_list = $this->movieDAO->GetAllMovies();
            }
            

            $genre_list = $this->genreDAO->getAllGenres();

            require_once(USER_PATH."billboard.php");
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


    }
?>