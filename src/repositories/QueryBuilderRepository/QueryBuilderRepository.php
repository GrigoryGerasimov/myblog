<?php

declare(strict_types=1);

namespace Rehor\Myblog\repositories\QueryBuilderRepository;

use Rehor\Myblog\repositories\QueryBuilderRepository\interfaces\QueryBuilderRepositoryInterface;
use Rehor\Myblog\models\QueryBuilder\QueryBuilder;

class QueryBuilderRepository implements QueryBuilderRepositoryInterface
{
    public static function QueryBuilderInstance(string $tableName)
    {
        return new QueryBuilder($tableName);
    }
    
    public static function buildSelectQuery(string $tableName, ?string $id = null): string
    {
        return is_null($id)
           ?
           self::QueryBuilderInstance($tableName)
              ->select(["*"])
              ->from()
              ->getQuery()
           :
           self::QueryBuilderInstance($tableName)
              ->select(["*"])
              ->from()
              ->where("uid", $id)
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
    
    public static function buildUpdateQuery(string $tableName, string $id, object $data): string
    {
        $dataArray = json_decode(json_encode($data), true);
        extract($dataArray, EXTR_SKIP);

        return self::QueryBuilderInstance($tableName)
           ->update()
           ->set("title", "'".$title."'")
           ->set("author", "'".$author."'")
           ->set("text", "'".$text."'")
           ->set("filepath", "'".$filepath."'")
           ->where("uid", $id)->getQuery();
    }
    
    public static function buildDeleteQuery(string $tableName, string $id): string
    {
        return self::QueryBuilderInstance($tableName)
           ->delete()
           ->from()
           ->where("uid", $id)
           ->getQuery();
    }
}