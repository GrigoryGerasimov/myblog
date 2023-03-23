<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\QueryBuilder;

use Rehor\Myblog\models\QueryBuilder\interfaces\{QueryCommandsInterface, QueryClausesInterface};

class QueryBuilder implements QueryCommandsInterface, QueryClausesInterface
{
    private $query = "";
    
    private $dbTableName;

    public function __construct(string $dbTableName)
    {
        $this->query = new \stdClass();
        $this->dbTableName = $dbTableName;
    }
    
    public function __destruct()
    {
        $this->query = null;
        $this->dbTableName = null;
    }
    
    public function select(array $params): self
    {
        $normalizedParams = implode(", ", $params);

        $this->query->core = "select $normalizedParams";
        $this->query->type[] = "select";
        
        return $this;
    }
    
    public function insert(): self
    {
        $this->query->core = "insert into $this->dbTableName ";
        $this->query->type[] = "insert";
        
        return $this;
    }
    
    public function ins_fields(array $fieldParams): self
    {
        $this->query->core .= "(".implode(', ', $fieldParams).")";
        
        return $this;
    }
        
    public function ins_values(array $valueParams): self
    {
        $this->query->core .= " values (".implode(', ', $valueParams).")";
        
        return $this;
    }
    
    public function update(): self
    {
        $this->query->core = "update $this->dbTableName ";
        $this->query->type[] = "update";
        
        return $this;
    }
    
    public function delete(): self
    {
        $this->query->core = "delete ";
        $this->query->type[] = "delete";
        
        return $this;
    }
    
    public function set(string $field, string $value): self
    {
        if (!in_array(implode(", ", $this->query->type), ["update"], true)) {
            throw new \Exception("SET can be defined only under UPDATE command");
        }

        $this->query->set[] = "$field = $value";
        
        return $this;
    }
    
    public function where(string $field, string $value, string $operator = "="): self
    {
        if (!in_array(implode(", ", $this->query->type), ["select", "insert", "update", "delete"], true)) {
            throw new \Exception("WHERE can be defined only under SELECT, INSERT, UPDATE or DELETE command");
        }
        
        $this->query->where[] = "$field $operator $value";
        
        return $this;
    }
    
    public function from(): self
    {
        if (!in_array(implode(", ", $this->query->type), ["select", "delete"])) {
            throw new \Exception("FROM can be defined only under SELECT or DELETE command");
        }

        $this->query->core .= " from $this->dbTableName";

        return $this;
    }
    
    public function getQuery(): string
    {
        if (isset($this->query->set)) {
            $this->query->core .= " set ".implode(", ", $this->query->set);
        }
        
        if (isset($this->query->where)) {
            $this->query->core .= " where ".implode("and ", $this->query->where);
        }

        return $this->query->core;
    }
}