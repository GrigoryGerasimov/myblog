<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\QueryBuilderRepository\interfaces;

interface QueryBuilderRepositoryInterface
{
    public static function buildSelectQuery(string $tableName, ?array $params = null): string;
    
    public static function buildInsertQuery(string $tableName, array $data): string;
    
    public static function buildUpdateQuery(string $tableName, ?array $params, array $data): string;
    
    public static function buildDeleteQuery(string $tableName, array $params): string;
}