<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\QueryBuilder\interfaces;

interface QueryBuilderInterface
{
   public function getQuery(): string;
}