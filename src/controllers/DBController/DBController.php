<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\DBController;

use Rehor\Myblog\controllers\DBController\interfaces\DBControllerInterface;
use Rehor\Myblog\models\QueryBuilder\QueryBuilder;

class DBController implements DBControllerInterface
{
    protected const DB_NAME = "myblog";
    
    protected const DB_TABLE_NAME = "posts";

    protected static function queryBuilder()
    {
        return new QueryBuilder(self::DB_TABLE_NAME);
    }

    protected static function db()
    {
        \Flight::register("db", "mysqli", array("localhost:5600", "root", "root", self::DB_NAME));
        
        return \Flight::db();
    }
    
    public static function select(?string $id = null): object
    {
        $sql = is_null($id) ?
           self::queryBuilder()->select(["*"])->from()->getQuery() :
           self::queryBuilder()->select(["*"])->from()->where("uid", $id)->getQuery();
        
        return self::db()->query($sql);
    }

    public static function insert(object $data): void
    {
        $dataArray = json_decode(json_encode($data), true);
        extract ($dataArray, EXTR_SKIP);        
        
        $sql = self::queryBuilder()->insert()->ins_fields(["title", "author", "text"])->ins_values(["'".$title."'", "'".$author."'", "'".$text."'"])->getQuery();
        self::db()->query($sql);
    }
    
    public static function update(string $id, object $data): object
    {
        $dataArray = json_decode(json_encode($data), true);
        extract($dataArray, EXTR_SKIP);

        $sql = self::queryBuilder()->update()->set("title", "'".$title."'")->set("author", "'".$author."'")->set("text", "'".$text."'")->where("uid", $id)->getQuery();
        self::db()->query($sql);
        
        return self::select($id);
    }
    
    public static function delete(string $id): void
    {
        $sql = self::queryBuilder()->delete()->from()->where("uid", $id)->getQuery();
        self::db()->query($sql);
    }
}