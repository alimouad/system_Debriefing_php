<?php
namespace App\Models;

class Brief{
    private $id;
    private $title;
    private $description;
    private $duration;
    private $type ;

    public function __construct($id, $title, $description, $duration, $type){
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->duration = $duration;
        $this->type = $type;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getdescription(){
        return $this->description;
    }
    public function getDuration(){
        return $this->duration;
    }
    public function getType(){
        return $this->type;
    }
}