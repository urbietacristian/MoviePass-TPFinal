<?php
    namespace DAO;

    use Models\Movie as Movie;
    

    class MovieDAO
    {
        private $movie_list = array();

        public function __construct()
        {
            $movieArray = json_decode(file_get_contents('http://api.themoviedb.org/3/movie/now_playing?api_key=af168fc809d4fb1ad12f6b57122de08c'), true);
            if($movieArray && $movieArray['results'] && count($movieArray['results']) != 0)
            {
                foreach($movieArray['results'] as $jsonMovie)
                {
                    $new_movie = new Movie();
                    $new_movie->setIdApi($jsonMovie['id']);
                    $new_movie->setDescription($jsonMovie['overview']);
                    $new_movie->setName($jsonMovie['title']);
                    $new_movie->setImage($jsonMovie['poster_path']);
                    $new_movie->setGenreIds($jsonMovie['genre_ids']);
                    $new_movie->setLanguage($jsonMovie['original_language']);
                    array_push($this->movie_list, $new_movie);
                }
            }
        }

        public function getAllMovies()
        {
            return $this->movie_list;
        }
        
    }
?>