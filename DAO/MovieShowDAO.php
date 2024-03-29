<?php
    namespace DAO;

    use Models\MovieShow as MovieShow;

    class MovieShowDAO{

    private $movieshowList = array();
    private $fileName;
    private $connection; 
    
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
            $result = $this->connection->execute($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }

        if(!empty($result)) 
        {   
            return true;
        }
        else
            return false;
    }

    public function getMovieShowByCinema($id_cinema){
        
        
        $sql = "select movieshow.* from movieshow inner join rooms on movieshow.id_room = rooms.id_room and rooms.id_cinema = :id_cinema";

        $parameters['id_cinema'] = $id_cinema;
        

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->execute($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }

        if(!empty($result)) 
        {   
            return $this->map($result);
        }
        else
            return false;
    }

    public function getMovieShowByRoom($id_room, $id_movie){
        
        $sql ="select * from movieshow where movieshow.id_movie = :id_movie and movieshow.id_room = :id_room ";

        $parameters['id_room'] = $id_room;
        $parameters['id_movie'] = $id_movie;
        

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->execute($sql, $parameters);
        }
        catch(\PDOException $ex){
            throw $ex;
        }
    

        if(!empty($result)) 
            return $this->map($result);
        else
            return false;
    }

    
    /**
     * Comprueba si la sala mandada por parametro tiene alguna movieshow
     * @param int id_room id de la sala a verificar
     * @return true si encontro alguna funcion en la sala
     * @return false si no encontro alguna funcion en la sala 
     */
    
    public function checkMovieShowByRoom($id_room){
        
        
        $sql = "select movieshow.* from movieshow inner join rooms on movieshow.id_room = :id_room";

        $parameters['id_room'] = $id_room;
        

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

 
    public function getDisplayableMovieShowByMovie($id_movie){

        $sql =" select movieshow.*, rooms.id_room, rooms.id_cinema, rooms.name as room_name, rooms.price, rooms.capacity,  cinemas.name as cinema_name
        from movieshow
        inner join rooms on rooms.id_room = movieshow.id_room 
        inner join cinemas on cinemas.id_cinema = rooms.id_cinema  AND TIMESTAMP(movieshow.day,movieshow.time) > NOW()
        where movieshow.id_movie = :id_movie " ;

        $parameters['id_movie'] = $id_movie;

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->execute($sql, $parameters);
        }
        catch(\PDOException $ex){
            throw $ex;
        }

        if(!empty($result))
        {
            $result = is_array($result) ? $result : [];
            
            return count($result) > 0 ? $result : $result['0'];
        }

        else
            return false;


        
    }

    protected function map($value){

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new MovieShow($p['id_movieshow'],$p['id_room'],$p['id_movie'],$p['day'], $p['time']);
        }, $value);

        return count($resp) > 0 ? $resp : $resp['0'];
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

           
    public function getMovieShowById($id_movieshow){

        $sql = "SELECT * FROM movieshow WHERE id_movieshow = :id_movieshow";

        $parameters['id_movieshow'] = $id_movieshow;

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



        
    public function verifyDifferentMovieOnRoom($id_cinema,$id_room,$date){

        $sql='select * from movieshow
        inner join rooms on rooms.id_room = movieshow.id_room and rooms.id_cinema = :id_cinema
        where movieshow.id_room != :id_room and movieshow.day = :date';

        $parameters['id_cinema'] = $id_cinema;
        $parameters['id_room'] = $id_room;
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




        
    public function verifyMovieOnCinemaRooms($id_cinema,$id_movie,$id_room){

        $sql='select * from rooms inner join movieshow on movieshow.id_movie = :id_movie and movieshow.id_room = rooms.id_room where rooms.id_cinema = :id_cinema and rooms.id_room != :id_room group by rooms.id_room';

        $parameters['id_cinema'] = $id_cinema;
        $parameters['id_movie'] = $id_movie;
        $parameters['id_room'] = $id_room;

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



