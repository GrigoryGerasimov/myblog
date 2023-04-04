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

    #[Column(type: "string", unique: true, nullable: false)]
    protected $username;
    
    #[Column(type: "string")]
    protected $firstname;
    
    #[Column(type: "string")]
    protected $lastname;

    #[Column(type: "string")]
    protected $filepath;

    #[Column(type: "integer", nullable: false)]
    protected $roles_mask;
    
    #[Column(type: "boolean")]
    protected $verified;
    
    #[Column(type: "integer", nullable: false)]
    protected $registered;
    
    #[column(type: "integer")]
    protected $last_login;
    
    public function __get($name)
    {
        return $this->$name;
    }
    
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}