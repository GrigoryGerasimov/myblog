<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\QueryBuilderRepository;

use Rehor\Myblog\repositories\QueryBuilderRepository\interfaces\QueryBuilderRepositoryInterface;
use Rehor\Myblog\models\QueryBuilder\QueryBuilder;

final class QueryBuilderRepository implements QueryBuilderRepositoryInterface
{
    public static function QueryBuilderInstance(string $tableName)
    {
        return new QueryBuilder($tableName);
    }
    
    public static function buildSelectQuery(string $tableName, ?array $params = null): string
    {
        if (!is_null($params)) {
            $arrayKey = key($params);
            $arrayValue = $params[$arrayKey];
        }
        
        return is_null($params)
           ?
           self::QueryBuilderInstance($tableName)
              ->select(["*"])
              ->from()
              ->getQuery()
           :
           self::QueryBuilderInstance($tableName)
              ->select(["*"])
              ->from()
              ->where($arrayKey, "'".$arrayValue."'")
              ->getQuery();
    }
    
    public static function buildInsertQuery(string $tableName, object $data): string
    {
        $dataArray = json_decode(json_encode($data), true);
        extract ($dataArray, EXTR_SKIP); 

        return self::QueryBuilderInstance($tableName)
           ->insert()
           ->ins_fields(["title", "author", "text", "filepath"])
           ->ins_values(["'".$title."'", "'".$author."'", "'".$text."'","'".$filepath."'"])
           ->getQuery();
    }
    
    public static function buildUpdateQuery(string $tableName, ?array $params, object $data): string
    {
        $arrayKey = key($params);
        $arrayValue = $params[$arrayKey];

        $dataArray = json_decode(json_encode($data), true);
        extract($dataArray, EXTR_SKIP);

        return self::QueryBuilderInstance($tableName)
           ->update()
           ->set("title", "'".$title."'")
           ->set("author", "'".$author."'")
           ->set("text", "'".$text."'")
           ->set("filepath", "'".$filepath."'")
           ->where($arrayKey, "'".$arrayValue."'")
           ->getQuery();
    }
    
    public static function buildDeleteQuery(string $tableName, ?array $params): string
    {
        $arrayKey = key($params);
        $arrayValue = $params[$arrayKey];

        return self::QueryBuilderInstance($tableName)
           ->delete()
           ->from()
           ->where($arrayKey, "'".$arrayValue."'")
           ->getQuery();
    }
}