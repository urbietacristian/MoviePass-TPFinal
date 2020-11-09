<?php 

namespace Models;


class Movie
{
    private $id_api;
    private $description;
    private $name;
    private $image;
    private $duration;
    private $genre_ids=array();
    private $language;
    private $releaseDate;


    public function __construct($id_api,$description,  $name, $duration,  $genre_ids, $image,$language, $release_date)
    {
        $this->setIdApi($id_api);
        $this->setDescription($description);
        $this->setName($name);
        $this->setImage($image);
        $this->setDuration($duration);
        $this->setGenreIds($genre_ids);
        $this->setLanguage($language);
        $this->setReleaseDate($release_date);
    }

    public function getDuration()
    {
        return $this->duration;
    }
    public function setDuration($duration)
    {
        $this->duration = $duration;
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

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }
}

?>