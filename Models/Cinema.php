<?php
namespace Models;

class Cinema
{
    private $id;
    private $name;
    private $address;
    private $ticket_price;
    private $total_capacity;


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

    public function getTicketPrice()
    {
        return $this->ticket_price;
    }

    public function setTicketPrice($ticket_price)
    {
        $this->ticket_price = $ticket_price;
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