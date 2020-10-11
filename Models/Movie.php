<?php namespace Models;


class Movie
{
    private $id_api;
    private $description;
    private $name;
    private $image;
    private $duration;
    private $category=array();
    private $language;
   



    public function __construct($id_api,$description,  $name, $duration,  $category, $image,$language)
    {
        $this->setId_api($id_api);
        $this->setDescription($description);
        $this->setName($name);
        $this->setDuration($duration);
        $this->setImage($image);
        $this->setCategory($category);
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
	 public function getId_api()
    {
        return $this->id_api;
    }
    public function setId_api($id_api)
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
   
    public function getDuration ()
    {
        return $this->duration;
    }
    public function setDuration($duration)
    {
        
        if($duration != null)
        {
            $this->duration = $duration;
        }

        else
        {
            $this->duration = 120;
        }
    }
    
     public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($category)
    {
        $this->category = $category;
    }
    

}

?>