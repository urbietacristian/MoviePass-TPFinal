<?php
    namespace DAO;

    use Models\Movie as Movie;
    use Models\Genre as Genre;
    

    class MoviesXGenresDAO
    {


        public function add($movie){
             
            $sql = 'INSERT INTO moviesxgenres
			(id_movie, id_genre) 
			VALUES 
            (:id_movie, :id_genre)';
            
            $parameters['id_movie'] = $movie->getIdApi();

            $array = array();
            $array = $movie->getGenreIds();
            


            foreach($array as $genre)
            {
            
                $parameters['id_genre'] = $genre;
                try{
                    $this->connection = Connection::getInstance();
                    $this->connection->executeNonQuery($sql, $parameters);
                
                }
                catch(\PDOException $ex){
                    throw $ex;
                }
        
            }

        }

        





    }


        



?>