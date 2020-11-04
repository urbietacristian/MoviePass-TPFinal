<?php
    namespace Controllers;
    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;
    use Models\Movie as Movie;
    use Models\Genre as Genre;

    class MovieController
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


        public function ShowMovieDetail($id_movie)
        {
            $movie = $this->movieDAO->read($id_movie);
            require_once(ADMIN_PATH."detail_movie.php");
        }

        public function showMovies($id = "")
        {
            
            if(!($id == "")){
                $movie_list = $this->getMoviesByGenre($id);
            }
            else{
                $movie_list = $this->movieDAO->getAllMovies();
            }

            $genre_list = $this->getActiveGenres();

            require_once(ADMIN_PATH."list_movies.php");
        }

        public function showActiveMovies($id = ""){
            
            if(!($id == "")){
                $movie_list = $this->getActiveMoviesByGenre($id);
            }
            else{
                $movie_list = $this->movieDAO->getMoviesOnFunctions();
            }

            $genre_list = $this->genreDAO->getAllGenres();

           

            require_once(USER_PATH."homeUser.php");
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
