<?php
    namespace DAO;

    use Models\User as User;

    class UserDAO{

    private $userList = array();
    private $fileName;


    public function Add(User $user){
        $this->RetrieveData();
        foreach ($this->GetAll() as $value){
            if ($user->getEmail() == $value->getEmail()){
                return 0;
            }
        }
        array_push($this->userList,$user);    
        $this->SaveData();
    }

    public function GetAll(){
        $this->RetrieveData();
        return $this->userList;
    }

    public function CompareEmail($email){
        $userList= $this->GetAll();
        foreach ($userList as $user){
            if ($user->getEmail() == $email){
                return true;
            }
        }
        return false;

    }
    

    private function SaveData(){
        $arrayToEncode = array();

        foreach($this->userList as $user){
            $valuesArray["user"] = $user->getEmail();
            $valuesArray["pass"] = $user->getPassword();
            $valuesArray["rol"] = $user->getRol();
            //$valuesArray["client"] = $user->getClient();
            array_push($arrayToEncode,$valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/users.json', $jsonContent);
    }

    private function RetrieveData(){
        
        $this->userList = array();

        if(file_exists('Data/users.json')){
            $jsonContent = file_get_contents('Data/users.json');
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
            
            foreach($arrayToDecode as $valuesArray){

                $user = new User();

                $user->setEmail($valuesArray["user"]);
                $user->setPassword($valuesArray["pass"]);
                $user->setRol($valuesArray["rol"]);
                //$user->setClient($valuesArray["client"]);
                array_push($this->userList,$user);
            }

        }
    }
}
?>