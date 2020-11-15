<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    class CinemaDAO{

    private $CinemaList = array();
    private $fileName;

    // public function Add(Cinema $Cinema){
    //     $this->RetrieveData();
    //     foreach ($this->GetAll() as $value){
    //         if ($Cinema->getName() == $value->getName()){
    //             return 0;
    //         }
    //     }
    //     array_push($this->CinemaList,$Cinema);    
    //     $this->SaveData();
    // }


    
    public function Add(Cinema $Cinema){
       
        $sql = "INSERT INTO cinemas (id_cinema, name, address) VALUES (:id_cinema, :name, :address)";

        $parameters['id_cinema'] = 0;
        $parameters['name'] = $Cinema->getName();
        $parameters['address'] = $Cinema->getAddress();

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }
    }


    public function Edit(Cinema $Cinema){
        $sql = "UPDATE cinemas SET name = :name, address = :address WHERE id_cinema = :id_cinema";

        $parameters['id_cinema'] = $Cinema->getId();
        $parameters['name'] = $Cinema->getName();
        $parameters['address'] = $Cinema->getAddress();


        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }
    }


    public function Remove($name){
        
        $sql = "DELETE FROM cinemas WHERE name = :name";

        $parameters['name'] = $name;

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }
    }

    // public function FixId(){

    //     $this->RetrieveData();
    //     $newCinemaList = array();
    //     $id = 0;
    //     foreach ($this->GetAll() as $value){
            
    //         $value->setId($id);  
    //         $id++;
    //     }
    //     $this->SaveData();
    // }


    

    public function read($name){

        $sql = "SELECT * FROM cinemas WHERE name = :name";

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
    
    public function getCinemaByID($id)
    {

        $sql = "SELECT * FROM cinemas WHERE id_cinema = :id_cinema";

        $parameters['id_cinema'] = $id;

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


    public function getCinemasIfMovieshow()
    {
        $sql = "select cinemas.* from movies inner join movieshow on  movieshow.id_movie = movies.id_api inner join rooms on movieshow.id_room = rooms.id_room inner join cinemas on rooms.id_cinema = cinemas.id_cinema  group by rooms.id_cinema";
      

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
    

    
    protected function map($value){

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new Cinema($p['id_cinema'],$p['name'],$p['address']);
        }, $value);

        return count($resp) > 0 ? $resp : $resp['0'];
    }






    public function GetAll(){
        $sql = "SELECT * FROM cinemas";

        
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

    public function CompareName($name){
        $CinemaList= $this->GetAll();
        foreach ($CinemaList as $Cinema){
            if ($Cinema->getName() == $name){
                return true;
            }
        }
        return false;

    }

    public function returnCinemaById($id){
        $CinemaList= $this->GetAll();
        foreach ($CinemaList as $Cinema){
            if ($Cinema->getId() == $id){
                return $Cinema;
            }
        }
        return false;

    }



    // private function SaveData(){
    //     $arrayToEncode = array();

    //     foreach($this->CinemaList as $Cinema){
    //         $valuesArray["id"] = $Cinema->getId();
    //         $valuesArray["name"] = $Cinema->getName();
    //         $valuesArray["address"] = $Cinema->getAddress();
    //         $valuesArray["ticket_price"] = $Cinema->getTicketPrice();
    //         $valuesArray["total_capacity"] = $Cinema->getTotalCapacity();
    //         array_push($arrayToEncode,$valuesArray);
    //     }

    //     $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
    //     file_put_contents('Data/cinemas.json', $jsonContent);
    // }

    // private function RetrieveData(){
        
    //     $this->CinemaList = array();

    //     if(file_exists('Data/cinemas.json')){
    //         $jsonContent = file_get_contents('Data/cinemas.json');
    //         $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
            
    //         foreach($arrayToDecode as $valuesArray){

    //             $Cinema = new Cinema();

    //             $Cinema->setId($valuesArray["id"]);
    //             $Cinema->setName($valuesArray["name"]);
    //             $Cinema->setAddress($valuesArray["address"]);
    //             $Cinema->setTicketPrice($valuesArray["ticket_price"]);
    //             $Cinema->setTotalCapacity($valuesArray["total_capacity"]);
    //             array_push($this->CinemaList,$Cinema);
    //         }

    //     }
    // }
}
?>