<?php
    namespace DAO;

    use Models\MovieShow as MovieShow;

    class MovieShowDAO{

    private $movieshowList = array();
    private $fileName;
    
    public function Add(MovieShow $movieShow){


       
        $sql = "INSERT INTO movieshow (id_movieshow, id_room, id_movie, time, day) VALUES (:id_movieshow, :id_room, :id_movie, :schedule, :date)";

        $parameters['id_movieshow'] = 0;
        $parameters['id_room'] = $movieShow->getidRoom();
        $parameters['id_movie'] = $movieShow->getidMovie();
        $parameters['schedule'] = $movieShow->getSchedule();
        $parameters['date'] = $movieShow->getDate();

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }
    }


    /**
     * Comprueba si el cine mandado por parametro tiene alguna movieshow
     * @param int id_cinema id del cine a verificar
     * @return true si encontro alguna funcion en el cine
     * @return false si no encontro alguna funcion en el cine 
     */
    
    public function checkMovieShowByCinema($id_cinema){
        
        
        $sql = "select movieshow.* from movieshow inner join rooms on movieshow.id_room = rooms.id_room and rooms.id_cinema = :id_cinema";

        $parameters['id_cinema'] = $id_cinema;
        

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->execute($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }

        if(!empty($result)) 
            return true;
        else
            return false;
    }






    
    public function Remove($id_movie, $id_room){
        
        $sql = "DELETE FROM movieshow WHERE id_room = :id_room AND id_movie = :id_movie";

        $parameters['id_room'] = $id_room;
        $parameters['id_movie'] = $id_movie;

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql, $parameters);
        }
        catch(\PDOException $ex){
            throw $ex;
        }
        
    }

    public function devolverFuncionesXidPelicula($dato){

        
    }

    protected function map($value){

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new MovieShow($p['id_movieshow'],$p['id_room'],$p['id_movie'],$p['day'], $p['time']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }


    
    public function read($name){

        $sql = "SELECT * FROM movieshow WHERE name = :name";

        $parameters['name'] = $name;

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





        
    public function verifyMovieOnCinema($id_cinema,$id_movie,$date){

        $sql='SELECT * FROM movieshow inner join rooms on rooms.id_cinema != :id_cinema WHERE rooms.id_room = movieshow.id_room AND movieshow.day= :date AND movieshow.id_movie=:id_movie';

        $parameters['id_cinema'] = $id_cinema;
        $parameters['id_movie'] = $id_movie;
        $parameters['date'] = $date;

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }
        catch(\PDOException $ex){
            throw $ex;
        }

        if(!empty($result))
            return false;
        else
            return true;
   
    }

    

    public function GetAll(){
        $sql = "SELECT * FROM movieshow";

        
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



}
?>



