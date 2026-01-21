<?php

class Evaluation{
    private $id;
    private $level;
    private $comment;
    private $evaluated_at;

    public function __construct($id, $level, $comment, $evaluated_at){
        $this->id = $id;
        $this->level = $level;
        $this->comment = $comment;
        $this->evaluated_at = $evaluated_at;
    }

    public function __get($name)
    {
        return $this->{$name} ?? null;
    }
}