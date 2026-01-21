<?php

namespace App\Models;

class Skill{
    private $id;
    private $code;
    private $label;

    public function __construct($id, $code, $label){
        $this->id = $id;
        $this->code = $code;
        $this->label = $label;
    }

    public function __get($code)
    {
        return $this->{$code} ?? null;
    }
}