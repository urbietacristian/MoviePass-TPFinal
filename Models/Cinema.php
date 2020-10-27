<?php
namespace Models;

class Cinema
{
    private $id;
    private $name;
    private $address;
    private $total_capacity;

    public function __construct($id, $name, $address, $total_capacity)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->total_capacity = $total_capacity;
        
    }

    /**
     * Getters y Setters
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getTotalCapacity()
    {
        return $this->total_capacity;
    }

    public function setTotalCapacity($total_capacity)
    {
        $this->total_capacity = $total_capacity;
    }    
}

?>