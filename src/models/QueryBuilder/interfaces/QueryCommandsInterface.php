<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\QueryBuilder\interfaces;

interface QueryCommandsInterface extends QueryBuilderInterface
{
    public function select(array $params): self;
    
    public function insert(): self;
    
    public function ins_fields(array $fieldParams): self;
    
    public function ins_values(array $valueParams): self;
    
    public function update(): self;
    
    public function delete(): self;
}