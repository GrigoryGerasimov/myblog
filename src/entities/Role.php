<?php

declare(strict_types=1);

namespace Rehor\Myblog\entities;

use \Doctrine\ORM\Mapping\{Entity, Table, Id, Column, GeneratedValue};

#[Entity]
#[Table(name: "roles")]
class Role
{
    #[Id, Column(type: "integer", unique: true, nullable: false), GeneratedValue]
    protected $id;

    #[Column(type: "string", unique: true, nullable: false)]
    protected $role_name;

    #[Column(type: "boolean", nullable: false)]
    protected $permission;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}