<?php namespace Models;

class Purchase
{
    private $id;
    private $account;
    private $date;
    private $discount;
    private $subtotal;
    private $total;


	public function __construct($account,$date,$discount, $subtotal, $total)
	{
        $this->setAccount($account);
        $this->setDate($date);
        $this->setDiscount($discount);
        $this->setSubtotal($subtotal);
        $this->setTotal($total);
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


    public function getAccount()
    {
        return $this->account;
    }


    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }


    public function getTickets()
    {
        return $this->tickets;
    }


    public function setTickets($tickets)
    {
        $this->tickets = $tickets;

        return $this;
    }


    public function getDate()
    {
        return $this->date;
    }

 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }


    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

 
    public function getTotal()
    {
        return $this->total;
    }


    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }


    public function getDiscount()
    {
        return $this->discount;
    }


    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }
}


?>