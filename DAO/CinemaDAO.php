<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    class CinemaDAO{

    private $cinemaList = array();
    private $fileName;

    public function Add(Cinema $cinema){
        $this->RetrieveData();
        foreach ($this->GetAll() as $value){
            if ($cinema->getName() == $value->getName()){
                return 0;
            }
            else return 1;
        }
        array_push($this->CinemaList, $cinema);    
        $this->SaveData();
    }

    public function GetAll(){
        $this->RetrieveData();
        return $this->cinemaList;
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

    private function SaveData(){
        $arrayToEncode = array();

        foreach($this->CinemaList as $Cinema){
            $valuesArray["id"] = $Cinema->getId();
            $valuesArray["name"] = $Cinema->getName();
            $valuesArray["address"] = $Cinema->getAddress();
            $valuesArray["ticket_price"] = $Cinema->getTicketPrice();
            $valuesArray["total_capacity"] = $Cinema->getTotalCapacity();
            array_push($arrayToEncode,$valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/Cinema.json', $jsonContent);
    }

    private function RetrieveData(){
        
        $this->CinemaList = array();

        if(file_exists('Data/Cinema.json')){
            $jsonContent = file_get_contents('Data/Cinema.json');
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
            
            foreach($arrayToDecode as $valuesArray){

                $Cinema = new Cinema();

                $Cinema->setId($valuesArray["id"]);
                $Cinema->setName($valuesArray["name"]);
                $Cinema->setAddress($valuesArray["address"]);
                $Cinema->setTicketPrice($valuesArray["ticket_price"]);
                $Cinema->setTotalCapacity($valuesArray["total_capacity"]);
                array_push($this->CinemaList,$Cinema);
            }

        }
    }
}
?>