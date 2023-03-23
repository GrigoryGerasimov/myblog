<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\DBController;

use Rehor\Myblog\controllers\DBController\interfaces\DBControllerInterface;
use Rehor\Myblog\repositories\QueryBuilderRepository\QueryBuilderRepository;

class DBController implements DBControllerInterface
{
    protected const DB_NAME = "myblog";
    
    protected const DB_TABLE_NAME = "posts";

    protected static function db()
    {
        \Flight::register("db", "mysqli", array("localhost:5600", "root", "root", self::DB_NAME));
        
        return \Flight::db();
    }
    
    public static function select(?string $id = null): object
    {
        $sql = QueryBuilderRepository::buildSelectQuery(self::DB_TABLE_NAME, $id);
        
        return self::db()->query($sql);
    }

    public static function insert(object $data): void
    {
        $sql = QueryBuilderRepository::buildInsertQuery(self::DB_TABLE_NAME, $data);

        self::db()->query($sql);
    }
    
    public static function update(string $id, object $data): object
    {
        $sql = QueryBuilderRepository::buildUpdateQuery(self::DB_TABLE_NAME, $id, $data);

        self::db()->query($sql);
        
        return self::select($id);
    }
    
    public static function delete(string $id): void
    {
        $sql = QueryBuilderRepository::buildDeleteQuery(self::DB_TABLE_NAME, $id);

        self::db()->query($sql);
    }
}