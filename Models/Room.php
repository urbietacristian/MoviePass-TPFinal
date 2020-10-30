<?php
namespace Models;

class Room
{
    private $id;
    private $name;
    private $price;
    private $capacity;
    private $id_cine;




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


    public function getId_cine()
    {
        return $this->id_cine;
    }


    public function setId_cine($id_cine)
    {
        $this->id_cine = $id_cine;

        return $this;
    }
}
?>