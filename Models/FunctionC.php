<?php namespace Models;


class FunctionC
{  
    private $id_function;
	private $id_sala;
	private $id_pelicula;
	private $horario;
    private $dia; 


    

    /**
     * Get the value of dia
     */ 
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set the value of dia
     *
     * @return  self
     */ 
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

	/**
	 * Get the value of horario
	 */ 
	public function getHorario()
	{
		return $this->horario;
	}

	/**
	 * Set the value of horario
	 *
	 * @return  self
	 */ 
	public function setHorario($horario)
	{
		$this->horario = $horario;

		return $this;
	}

    /**
     * Get the value of id_funcion
     */ 
    public function getId_funcion()
    {
        return $this->id_function;
    }

    /**
     * Set the value of id_funcion
     *
     * @return  self
     */ 
    public function setId_funcion($id_function)
    {
        $this->id_function = $id_function;

        return $this;
    }

	/**
	 * Get the value of id_sala
	 */ 
	public function getId_sala()
	{
		return $this->id_sala;
	}

	/**
	 * Set the value of id_sala
	 *
	 * @return  self
	 */ 
	public function setId_sala($id_sala)
	{
		$this->id_sala = $id_sala;

		return $this;
	}

	/**
	 * Get the value of id_pelicula
	 */ 
	public function getId_pelicula()
	{
		return $this->id_pelicula;
	}

	/**
	 * Set the value of id_pelicula
	 *
	 * @return  self
	 */ 
	public function setId_pelicula($id_pelicula)
	{
		$this->id_pelicula = $id_pelicula;

		return $this;
	}
}

?>