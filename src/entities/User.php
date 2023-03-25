<?php

declare(strict_types=1);

namespace Rehor\Myblog\entities;

use \Doctrine\ORM\Mapping\{Entity, Table, Id, Column, GeneratedValue};

#[Entity]
#[Table(name: "users")]
class User
{
    #[Id, Column(type: "integer"), GeneratedValue]
    protected $id;
    
    #[Column(type: "string", unique: true, nullable: false)]
    protected $email;
    
    #[Column(type: "string", unique: true, nullable: false)]
    protected $password;
    
    #[Column(type: "string", nullable: false)]
    protected $firstname;
    
    #[Column(type: "string", nullable: false)]
    protected $lastname;
    
    public function __get($name)
    {
        return $this->$name;
    }
    
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}