<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\QueryBuilderRepository\interfaces;

interface QueryBuilderRepositoryInterface
{
    public static function buildSelectQuery(string $tableName, ?string $id = null): string;
    
    public static function buildInsertQuery(string $tableName, object $data): string;
    
    public static function buildUpdateQuery(string $tableName, string $id, object $data): string;
    
    public static function buildDeleteQuery(string $tableName, string $id): string;
}