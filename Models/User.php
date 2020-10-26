<?php namespace Models;

class User
{
    private $id_user;
	private $email;
	private $password;
	private $rol;
    //private $client;

    
    public function __construct($id_user, $email, $password, $rol)
	{
        $this->setId($id_user);
		$this->setEmail($email);
		$this->setPassword($password);
		$this->setRol($rol);
		
    }
    
    
    public function getId()
    {
        return $this->id_user;
    }

 
    public function setId($id)
    {
        $this->id_user = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

 
    public function setEmail($email)
    {
        if(strlen($email)<30 && strlen($email)>2)
        $this->email = $email;
    }

   
    public function getPassword()
    {
        return $this->password;
    }

 
    public function setPassword($password)
    {
        if(strlen($password)<30 && strlen($password)>2)
        $this->password = $password;
    }

    
    public function getRol()
    {
        return $this->rol;
    }

    
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /*
    public function getClient()
    {
        return $this->client;
    }

    
    public function setClient($client)
    {
        $this->client = $client;
    }   
    */

    


}

?>