<?php
    use DAO/MovieDAO as MovieDAO;
    use DAO/GenreDAO as GenreDAO;
    use Models/Movie as Movie;
    use Models/Genre as Genre;

    class BillboardController
    {
        private $movieDAO;
        private $genreDAO;

        public function __construct()
        {
            $this->movieDAO = new MovieDAO;
            $this->genreDAO = new GenreDAO;
        }

        public function showBillboardView($message = "")
        {
            require_once(VIEWSPATH."billboard.php");
        }

        public function showMovies()
        {
            $movie_list = $this->movieDAO->getAllMovies();
            $genre_list = $this->genreDAO->getAllGenres();

            require_once(VIEWSPATH."billboard.php");
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