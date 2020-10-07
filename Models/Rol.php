<?php namespace Models;


class Rol 
{
	private $id;
	private $name;
	private $description;

	function __construct($name,$description)

	{
		$this->setName($name);
		$this->setDescription($description);
		
	}


	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function getName(){
		return $this->name;
	}
	public function setDescription($description){
		$this->description = $description;
	}
	public function getDescription(){
		return $this->description;
	}
}

?>