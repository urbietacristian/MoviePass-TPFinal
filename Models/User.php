<?php namespace Models;

class User
{
    private $id_user;
	private $email;
	private $password;
    private $rol;
    private $first_name;
    private $last_name;
    private $dni;

    //private $client;

    
    public function __construct($id_user, $email, $password, $rol, $first_name, $last_name, $dni)
	{
        $this->setId($id_user);
		$this->setEmail($email);
		$this->setPassword($password);
        $this->setRol($rol);
        $this->setFirstName($first_name);
        $this->setLastName($last_name);
        $this->setDni($dni);
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

    public function getFirstName()
    {
        return $this->first_name;
    }
    
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }
    
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getDni()
    {
        return $this->dni;
    }
    
    public function setDni($dni)
    {
        $this->dni = $dni;
    }
}

?>