<?php namespace Models;

class Ticket
{
    private $id_ticket;
    private $ticket_number;
    private $id_movieshow;
    private $id_purchase;


	public function __construct($id_ticket, $ticket_number, $id_movieshow, $id_purchase)
	{
        $this->setId($id_ticket);
		$this->setTicketNumber($ticket_number);
        $this->setMovieShow($id_movieshow);
        $this->setIdPurchase($id_purchase);
	}
    
    public function getId()
    {
        return $this->id_ticket;
    }

 
    public function setId($id)
    {
        $this->id_ticket = $id;
    }

    public function getTicketNumber()
    {
        return $this->ticket_number;
    }

 
    public function setTicketNumber($ticket_number)
    {
        $this->ticket_number = $ticket_number;
    }

    public function getMovieShow()
    {
        return $this->id_movieshow;
    }

 
    public function setMovieShow($id_movieshow)
    {
        $this->id_movieshow = $id_movieshow;
    }

   
    

    /**
     * Get the value of id_purchase
     */ 
    public function getIdPurchase()
    {
        return $this->id_purchase;
    }

    /**
     * Set the value of id_purchase
     *
     * @return  self
     */ 
    public function setIdPurchase($id_purchase)
    {
        $this->id_purchase = $id_purchase;

        return $this;
    }
}
?>