<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\QueryBuilder\interfaces;

interface QueryClausesInterface extends QueryBuilderInterface
{
    public function where(string $field, string $value, string $operator = "="): self;
    
    public function from(): self;
    
    public function set(string $field, string $value): self;
}