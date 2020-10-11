<?php

class UserRepository
{
    private $userList = array();
    private $fileName = "/Data/user.json";

    public function add(User $user)
    {
        $this->retrieveData();
        array_push($this->userList, $user);
        $this->saveData();
    }

    public function getAll()
    {
        $this->retrieveData();
        return $this->userList;
    }

    private function saveData()
    {
        $arrayToEncode = array();

        foreach($this->userList as $user)
        {
            $arrayAux["id"] = $user->getId();
            $arrayAux["name"] = $user->getName();
            $arrayAux["lastName"] = $user->getLastName();
            $arrayAux["phone"] = $user->getPhone();
            $arrayAux["adress"] = $user->getAdress();
            $arrayAux["city"] = $user->getCity();
            $arrayAux["creditCardNumber"] = $user->getCreditCardNumber();
            array_push($arrayToEncode, $arrayAux);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    private function retrieveData()
    {
        $this->userList = array();

        if(file_existe($this->fileName))
        {
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDeCode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDeCode as $valuesArray)
            {
                $user = new User();
                $user->setId($valuesArray["id"]);
                $user->setName($valuesArray["name"]);
                $user->setLastName($valuesArray["lastName"]);
                $user->setPhone($valuesArray["phone"]);
                $user->setAdress($valuesArray["adress"]);
                $user->setCity($valuesArray["city"]);
                $user->setCreditCardNumber($valuesArray["creditCardNumber"]);
                array_push($this->userList, $user);c
            }
        }

    }
}

?>
