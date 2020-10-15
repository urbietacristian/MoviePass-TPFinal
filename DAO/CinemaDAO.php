<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    class CinemaDAO{

    private $CinemaList = array();
    private $fileName;

    public function Add(Cinema $Cinema){
        $this->RetrieveData();
        foreach ($this->GetAll() as $value){
            if ($Cinema->getName() == $value->getName()){
                return 0;
            }
        }
        array_push($this->CinemaList,$Cinema);    
        $this->SaveData();
    }

    public function GetAll(){
        $this->RetrieveData();
        return $this->CinemaList;
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
        file_put_contents('Data/cinemas.json', $jsonContent);
    }

    private function RetrieveData(){
        
        $this->CinemaList = array();

        if(file_exists('Data/cinemas.json')){
            $jsonContent = file_get_contents('Data/cinemas.json');
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