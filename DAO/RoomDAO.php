<?php
    namespace DAO;

    use Models\Room as Room;

class RoomDAO{

    private $roomList = array();
    private $fileName;
    private $connection;


    public function Add(Room $room){

        $sql = "INSERT INTO rooms (id_room, name, price, capacity, id_cine) VALUES (:id_room, :name, :price, :capacity, :id_cine)";

        $parameters['id_room'] = 0;
        $parameters['name'] = $room->getName();
        $parameters['price'] = $room->getPrice();
        $parameters['capacity'] = $room->getCapacity();
        $parameters['id_cine'] = $room->getId_cine();

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }
    }


    
    public function Edit(Room $room){
        $sql = "UPDATE rooms SET id_room = :id_room, name = :name, price = :price, capacity = :capacity   WHERE id_room = :id_room";

        $parameters['id_room'] = $room->getId();
        $parameters['name'] = $room->getName();
        $parameters['price'] = $room->getPrice();
        $parameters['capacity'] = $room->getCapacity();
        $parameters['id_cine'] = $room->getId_cine();

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }
    }


    public function Remove($name){
        
        $sql = "DELETE FROM rooms WHERE name = :name";

        $parameters['name'] = $name;

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }
    }

    protected function map($value){

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new Room($p['id'],$p['name'],$p['price'],$p['capacity'], $p['id_cine']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }


    
    public function read($name){

        $sql = "SELECT * FROM rooms WHERE name = :name";

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
        $sql = "SELECT * FROM rooms";

        
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