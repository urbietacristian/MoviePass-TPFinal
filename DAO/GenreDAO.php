<?php
    namespace DAO;

    
    use Models\Genre as Genre;

    class GenreDAO
    {
        private $genre_list = array();

        public function __construct()
        {
            $genreArray = json_decode(file_get_contents('http://api.themoviedb.org/3/genre/movie/list?api_key=af168fc809d4fb1ad12f6b57122de08c&language=es'), true);
            if($genreArray && $genreArray['genres'] && count($genreArray['genres']) != 0)
            {
                foreach($genreArray['genres'] as $genre)
                {
                    $new_genre = new Genre($genre['id'], $genre['name'] );
                    array_push($this->genre_list, $new_genre);
                }
            }
        }

        public function add($genre)
        {
            $sql = "INSERT INTO genres (id_genre, name) VALUES (:id_genre, :name)";

            $parameters['id_genre'] = $genre->getId();
            $parameters['name'] = $genre->getName();


            

            try{
                $this->connection = Connection::getInstance();
                $save = $this->connection->executeNonQuery($sql, $parameters);
                return $save;
            
            }
            catch(\PDOException $ex){
                throw $ex;
            }

        }


        public function updateGenres()
        {
            $genreArray = json_decode(file_get_contents('http://api.themoviedb.org/3/genre/movie/list?api_key=af168fc809d4fb1ad12f6b57122de08c&language=es'), true);
            if($genreArray && $genreArray['genres'] && count($genreArray['genres']) != 0)
            {
                foreach($genreArray['genres'] as $genre)
                {
                    $new_genre = new Genre();
                    $new_genre->setId($genre['id']);
                    $new_genre->setName($genre['name']);
                    $this->add($new_genre);
                }
            }


        }
        public function getAllGenres(){ 
            $sql = "SELECT * FROM  genres";


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




        public function getNameById($id)
        {
            foreach($this->genre_list as $genre)
            {
                if($genre->getId() == $id)
                {
                    return $genre->getName();
                }
            }
        }

        public function getGenreById($id)
        {
            foreach($this->genre_list as $genre)
            {
                if($genre->getId() == $id)
                {
                    return $genre;
                }
            }
        }

        
    protected function map($value){

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new Genre($p['id_genre'],$p['name']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }
    }
?>