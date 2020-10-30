<?php
    namespace DAO;

    use Models\MovieShow as MovieShow;

    class MovieShowDAO{

    private $movieshowList = array();
    private $fileName;
    
    public function Add(MovieShow $movieShow){


       
        $sql = "INSERT INTO functions (id_movieshow, id_room, id_movie, schedule, date) VALUES (:id_movieshow, :id_room, :id_movie, :schedule, :date)";

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


    
    public function Remove($id_movie, $id_room){
        
        $sql = "DELETE FROM functions WHERE id_room = :id_room AND id_movie = :id_movie";

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

        try
        {
            $salaDAO= new SalasDAO();
            $peliDAO= new PeliculasDAO();
            $arrayFunciones = array();
            $query = 'SELECT * FROM functions inner join movies ON functions.id_movies=Moives.id_api WHERE functions .id_movie=:id_movie'; //devuelve todas las funciones asociadas a una pelicula



            $parameters['id_movieshow'] = 0;
            $parameters['id_room'] = $movieShow->getidRoom();
            $parameters['id_movie'] = $movieShow->getidMovie();
            $parameters['schedule'] = $movieShow->getSchedule();
            $parameters['date'] = $movieShow->getDate();
        
            $pdo = new Connection();
            $connection = $pdo->Connect();
            $command = $connection->prepare($query);
            $command->bindParam(':id', $dato);
        
            $command->execute();
        
            while ($row = $command->fetch())
            {
                $id_sala = ($row['id_sala']);
                $id_pelicula = ($row['id_pelicula']);
                $dia = ($row['dia']);
                $horario = ($row['horario']);
                $id=($row['id_funcion']);
        
                $object = new \Models\Funcion($salaDAO->buscarPorID($id_sala),$peliDAO->buscarPorID($id_pelicula),$horario,$dia);
                $object->setID($row['id_funcion']);
                array_push($arrayFunciones, $object);
        
            }
        
            return $arrayFunciones; //retorno lista de funciones
        }
        catch (PDOException $ex) {
    
            throw $ex;
        }
        catch (Exception $e) {
    
            throw $e;
        }
    }

    protected function map($value){

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new Function($p['id_cinemashow'],$p['id_room'],$p['id_movie'],$p['day'], $p['time']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }


    
    public function read($name){

        $sql = "SELECT * FROM functions WHERE name = :name";

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

    public function GetAll(){
        $sql = "SELECT * FROM functions";

        
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



