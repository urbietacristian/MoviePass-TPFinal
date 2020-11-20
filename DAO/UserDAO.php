<?php
    namespace DAO;

    use Models\User as User;

    class UserDAO{

    private $userList = array();
    private $fileName;
    private $connection;


    public function Add(User $user){
        // $this->RetrieveData();
        // foreach ($this->GetAll() as $value){
        //     if ($user->getEmail() == $value->getEmail()){
        //         return 0;
        //     }
        // }
        // array_push($this->userList,$user);    
        // $this->SaveData();

        $sql = "INSERT INTO users (id_user, email, password, id_role, firstname, lastname, dni) VALUES (:id_user, :email, :password, :id_role, :firstname, :lastname, :dni)";

        $parameters['id_user'] = 0;
        $parameters['email'] = $user->getEmail();
        $parameters['password'] = $user->getPassword();
        $parameters['id_role'] = $user->getRol();
        $parameters['firstname'] = $user->getFirstName();
        $parameters['lastname'] = $user->getLastName();
        $parameters['dni'] = $user->getDni();

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->executeNonQuery($sql, $parameters);
        
        }
        catch(\PDOException $ex){
            throw $ex;
        }
    }


    public function read($email){

        $sql = "SELECT * FROM users WHERE email = :email";

        $parameters['email'] = $email;

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->execute($sql,$parameters);
        }
        catch(\PDOException $ex){
            throw $ex;
        }

        if(!empty($result)){
            return $this->map($result);
        }
        else
            return false;

        
    }

 

    // public function GetAll(){
    //     $this->RetrieveData();
    //     return $this->userList;
    // }

    // public function CompareEmail($email){
    //     $userList= $this->GetAll();
    //     foreach ($userList as $user){
    //         if ($user->getEmail() == $email){
    //             return true;
    //         }
    //     }
    //     return false;

    // }

    protected function map($value){

        $value = is_array($value) ? $value : [];

        $resp = array_map(function($p){
            return new User($p['id_user'],$p['email'],$p['password'],$p['id_role'],$p['firstname'], $p['lastname'], $p['dni']);
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];
    }



    
/*
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
    */
}
?>