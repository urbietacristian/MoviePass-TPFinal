<?php namespace Models;


class MovieShow
{  
    private $id_movieshow;
	private $id_room;
	private $id_movie;
	private $schedule;
	private $date; 
	

public function __construct($id_movieshow, $id_room, $id_movie, $date, $schedule)
    {
        $this->id_movieshow = $id_movieshow;
		$this->id_room = $id_room;
		$this->id_movie = $id_movie;
		$this->schedule = $schedule;
		$this->date = $date;
        
    }

    
    public function getSchedule()
    {
        return $this->schedule;
    }


    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;

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

  
    public function getidMovieshow()
    {
        return $this->id_function;
    }


    public function setidMovieshow($id_movieshow)
    {
        $this->id_movieshow = $id_movieshow;

        return $this;
    }


	public function getidRoom()
	{
		return $this->id_room;
	}


	public function setidRoom($id_room)
	{
		$this->id_room = $id_room;

		return $this;
	}


	public function getidMovie()
	{
		return $this->id_movie;
	}

 
	public function setidMovie($id_movie)
	{
		$this->id_movie = $id_movie;

		return $this;
	}

    /**
     * Get the value of id_movieshow
     */ 
    public function getId()
    {
        return $this->id_movieshow;
    }

    /**
     * Set the value of id_movieshow
     *
     * @return  self
     */ 
    public function setId($id_movieshow)
    {
        $this->id_movieshow = $id_movieshow;

        return $this;
    }
}

?>