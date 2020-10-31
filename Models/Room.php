<?php
namespace Models;

class Room
{
    private $id;
    private $name;
    private $price;
    private $capacity;
    private $id_cinema;

    function __construct($id,$name, $price, $capacity, $id_cinema)
	{
		$this->setId($id);
        $this->setName($name);
        $this->setPrice($price);
        $this->setCapacity($capacity);
        $this->setidCinema($id_cinema);
		
	}




    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    public function getPrice()
    {
        return $this->price;
    }


    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }


    public function getCapacity()
    {
        return $this->capacity;
    }


    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }


    public function getidCinema()
    {
        return $this->id_cinema;
    }


    public function setidCinema($id_cinema)
    {
        $this->id_cinema = $id_cinema;

        return $this;
    }
}
?>