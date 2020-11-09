<?php
    namespace DAO;

    use Models\Movie as Movie;
    use DAO\MoviesXGenresDAO as MoviesXGenresDAO;

    class MovieDAO
    {
        private $movie_list = array();
        private $moviesxgenresDAO;
        private $connection; 

        public function __construct()
        {
            
            $movieArray = json_decode(file_get_contents('http://api.themoviedb.org/3/movie/now_playing?api_key=af168fc809d4fb1ad12f6b57122de08c&language=es'), true);
            if($movieArray && $movieArray['results'] && count($movieArray['results']) != 0)
            {
                foreach($movieArray['results'] as $jsonMovie)
                {
                    $details = json_decode(file_get_contents("http://api.themoviedb.org/3/movie/". $jsonMovie['id'] ."?api_key=af168fc809d4fb1ad12f6b57122de08c"),true);
                    $new_movie = new Movie(
                    ($jsonMovie['id']),
                    ($jsonMovie['overview']),
                    ($jsonMovie['title']),
                    ($details['runtime']),
                    ($jsonMovie['genre_ids']),
                    ($jsonMovie['poster_path']),
                    ($jsonMovie['original_language']),
                    ($details['release_date'])

                    );
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
                    $details = json_decode(file_get_contents("http://api.themoviedb.org/3/movie/". $jsonMovie['id'] ."?api_key=af168fc809d4fb1ad12f6b57122de08c"),true);
                    $new_movie = new Movie(
                    ($jsonMovie['id']),
                    ($jsonMovie['overview']),
                    ($jsonMovie['title']),
                    ($details['runtime']),
                    ($jsonMovie['genre_ids']),
                    ($jsonMovie['poster_path']),
                    ($jsonMovie['original_language']),
                    ($details['release_date'])
                    );
                    $this->add($new_movie);
                }
            }
        }

        public function update($movie)
        {
            $sql = "UPDATE movies
            SET movies.release_date = :release_date
            WHERE movies.id_api = :id_movie;";

            $parameters['id_movie'] = $movie->getIdApi();
            $parameters['release_date'] = $movie->getReleaseDate();

            try{
                $this->connection = Connection::getInstance();
                $save = $this->connection->executeNonQuery($sql, $parameters);
            }
            catch(\PDOException $ex){
                throw $ex;
            }
            return $save;

        }

        public function getAllMovies(){ 
            $sql = "SELECT * FROM  movies";


            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql);
            }
            catch(\PDOException $ex){
                throw $ex;
            }

            if(!empty($result))
                return $this->map($result);
            else
                return false;
        }

        public function getMoviesOnFunctions(){ 
            $sql = "select movies.*  from movieshow inner join movies on  movieshow.id_movie = movies.id_api group by movies.id_api";
            


            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql);
            }
            catch(\PDOException $ex){
                throw $ex;
            }

            if(!empty($result))
                return $this->map($result);
            else
                return false;
        }

        // public function getMoviesByDate(){ 
        //     $sql = "SELECT id_api FROM  movies inner join movieshow on id_genre = :id_genre
        //     group by movies.id_api";

        //     $parameters['id_genre'] = $id_genre;


        //     try{
        //         $this->connection = Connection::getInstance();
        //         $result = $this->connection->execute($sql, $parameters);
        //     }
        //     catch(\PDOException $ex){
        //         throw $ex;
        //     }

        //     if(!empty($result))
        //         return $this->map($result);
        //     else
        //         return false;
        // }

        public function getMoviesOnFunctionsByDate(){ 
            $sql = "select movies.*  from movieshow inner join movies on  movieshow.id_movie = movies.id_api group by movies.id_api ORDER BY movies.release_date ASC";
            


            try{
                $this->connection = Connection::getInstance();
                $result = $this->connection->execute($sql);
            }
            catch(\PDOException $ex){
                throw $ex;
            }

            if(!empty($result))
                return $this->map($result);
            else
                return false;
        }



        public function add($movie)
        {
            $sql = "INSERT IGNORE INTO movies (id_api, name, description, image, language, duration, release_date) VALUES (:id_api, :name, :description, :image, :language, :duration, :release_date)";

            $parameters['id_api'] = $movie->getIdApi();
            $parameters['name'] = $movie->getName();
            $parameters['description'] = $movie->getDescription();
            $parameters['image'] = $movie->getImage();
            $parameters['language'] = $movie->getLanguage();
            $parameters['duration'] = $movie->getDuration();
            $parameters['release_date'] = $movie->getReleaseDate();            

            try{
                $this->connection = Connection::getInstance();
                $save = $this->connection->executeNonQuery($sql, $parameters);
            }
            catch(\PDOException $ex){
                throw $ex;
            }
            //$this->moviesxgenresDAO->add($movie);
            return $save;
        }




    public function read($id_movie){

        $sql = "SELECT * FROM movies WHERE id_api = :id_api";

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

    public function getMoviesByCinema($id_cinema)
    {
        $sql = "select movies.* from movies inner join movieshow on  movieshow.id_movie = movies.id_api inner join rooms on movieshow.id_room = rooms.id_room AND rooms.id_cinema = :id_cinema group by movies.id_api ";

        $parameters['id_cinema'] = $id_cinema;

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


    public function getGenresByMovie($id_movie)
    {
        $sql = "SELECT id_genre FROM moviesxgenres WHERE id_movie = :id_movie";

        $parameters['id_movie'] = $id_movie;

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }
        catch(\PDOException $ex){
            throw $ex;
        }

        if(!empty($result))
            return $this->getIdGenres($result);
        else
            return false;

    }



    protected function getIdGenres($value){

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return $p['id_genre'];
        }, $value);

        return $resp;
    }


    protected function map($value){

        $value = is_array($value) ? $value : [];

        
        $resp = array_map(function($p){
            return new Movie($p['id_api'],$p['description'], $p['name'],$p['duration'], $this->getGenresByMovie($p['id_api']),$p['image'], $p['language'], $p['release_date']);
        }, $value);

        return count($resp) > 0 ? $resp : $resp['0'];
    }

        
    }
?>