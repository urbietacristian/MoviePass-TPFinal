<?php
    namespace DAO;

    use Models\Movie as Movie;
    use DAO\MoviesXGenresDAO as MoviesXGenresDAO;

    class MovieDAO
    {
        private $movie_list = array();
        private $moviesxgenresDAO;

        public function __construct()
        {
            
            $movieArray = json_decode(file_get_contents('http://api.themoviedb.org/3/movie/now_playing?api_key=af168fc809d4fb1ad12f6b57122de08c&language=es'), true);
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
                    $details = json_decode(file_get_contents("http://api.themoviedb.org/3/movie/". $jsonMovie['id'] ."?api_key=af168fc809d4fb1ad12f6b57122de08c"),true);
                    $new_movie->setDuration($details['runtime']);
                    array_push($this->movie_list, $new_movie);
                }
            }
        }

        public function updateMovies()
        {
            $this->moviesxgenresDAO = new MoviesXGenresDAO();
            $movieArray = json_decode(file_get_contents('http://api.themoviedb.org/3/movie/now_playing?api_key=af168fc809d4fb1ad12f6b57122de08c&language=es'), true);
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
                    $details = json_decode(file_get_contents("http://api.themoviedb.org/3/movie/". $jsonMovie['id'] ."?api_key=af168fc809d4fb1ad12f6b57122de08c"),true);
                    $new_movie->setDuration($details['runtime']);
                    $this->add($new_movie);
                }
            }


        }


        public function add($movie)
        {
            $sql = "INSERT INTO movies (id_api, name, description, image, language, duration) VALUES (:id_api, :name, :description, :image, :language, :duration)";

            $parameters['id_api'] = $movie->getIdApi();
            $parameters['name'] = $movie->getName();
            $parameters['description'] = $movie->getDescription();
            $parameters['image'] = $movie->getImage();
            $parameters['language'] = $movie->getLanguage();
            $parameters['duration'] = $movie->getDuration();

            

            try{
                $this->connection = Connection::getInstance();
                $save = $this->connection->executeNonQuery($sql, $parameters);
            }
            catch(\PDOException $ex){
                throw $ex;
            }
            $this->moviesxgenresDAO->add($movie);
            return $save;

        }

        
    public function read($id_movie){

        $sql = "SELECT * FROM cinemas WHERE id_api = :id_api";

        $parameters['id_api'] = $id_movie;

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }
        catch(\PDOException $ex){
            throw $ex;
        }

        if(!empty($result))
            return $this->map($result);
        else
            return false;

    }

    protected function map($value){

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new Movie($p['id_api'],$p['name'],$p['image'],$p['duration'], $p['genre_ids'], $p['language']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }



        public function getAllMovies()
        {
            return $this->movie_list;
        }
        
    }
?>