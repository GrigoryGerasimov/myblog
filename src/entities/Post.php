<?php

declare(strict_types=1);

namespace Rehor\Myblog\entities;

use \Doctrine\ORM\Mapping\{Entity, Table, Id, Column, GeneratedValue};

#[Entity]
#[Table(name: "posts")]
class Post
{
    #[Id, Column(type: "integer"), GeneratedValue]
    protected $uid;
    
    #[Column(type: "string", nullable: false)]
    protected $title;
    
    #[Column(type: "string", nullable: false)]
    protected $author;
    
    #[Column(type: "string", nullable: false)]
    protected $text;

    #[Column(type: "string")]
    protected $filepath;
    
    public function __get($name)
    {
        return $this->$name;
    }
    
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}