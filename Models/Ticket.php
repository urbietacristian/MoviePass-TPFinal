<?php namespace Models;

class Ticket
{
    private $id;
    private $ticket_number;
    private $show;


	public function __construct($ticket_number, $show)
	{
		$this->setNumeroEntrada($ticket_number);
        $this->setShow($show);
	}
    
    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNumeroEntrada()
    {
        return $this->ticket_number;
    }

 
    public function setNumeroEntrada($ticket_number)
    {
        $this->ticket_number = $ticket_number;
    }

    public function getShow()
    {
        return $this->show;
    }

 
    public function setShow($show)
    {
        $this->show = $show;
    }

   
    
}
?>