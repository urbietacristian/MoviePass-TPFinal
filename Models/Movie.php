<?php 

namespace Models;


class Movie
{
    private $id_api;
    private $description;
    private $name;
    private $image;
    private $genre_ids;
    private $language;


    public function __construct($id_api,$description,  $name, $duration,  $genre_ids, $image,$language)
    {
        $this->setIdApi($id_api);
        $this->setDescription($description);
        $this->setName($name);
        $this->setImage($image);
        $this->setGenreIds($genre_ids);
        $this->setLanguage($language);
        
    }
     public function getLanguage()
    {
        return $this->language;
    }
    public function setLanguage($language)
    {
        $this->language = $language;
    }
     public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
	 public function getIdApi()
    {
        return $this->id_api;
    }
    public function setIdApi($id_api)
    {
        $this->id_api = $id_api;
    }

    public function getDescription ()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getName ()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
   
     public function getGenreIds()
    {
        return $this->genre_ids;
    }
    public function setGenreIds($genre_ids)
    {
        $this->genre_ids = $genre_ids;
    }
}

?>