<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\DBController;

use Rehor\Myblog\controllers\DBController\interfaces\DBControllerInterface;
use Rehor\Myblog\repositories\QueryBuilderRepository\QueryBuilderRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;

class DBController implements DBControllerInterface
{
    protected const DB_NAME = "myblog";
    
    protected const DB_TABLE_NAME = "posts";

    protected static function db()
    {
        return DBConnectorFlightRepository::initConnector(self::DB_NAME);
    }
    
    public static function getDBName()
    {
        return self::DB_NAME;
    }
    
    public static function select(?array $params = null): object
    {
        $sql = QueryBuilderRepository::buildSelectQuery(self::DB_TABLE_NAME, $params);
        
        return self::db()->query($sql);
    }

    public static function insert(object $data): void
    {
        $sql = QueryBuilderRepository::buildInsertQuery(self::DB_TABLE_NAME, $data);

        self::db()->query($sql);
    }
    
    public static function update(?array $params, object $data): object
    {
        $sql = QueryBuilderRepository::buildUpdateQuery(self::DB_TABLE_NAME, $params, $data);

        self::db()->query($sql);
        
        return self::select($params);
    }
    
    public static function delete(?array $params): void
    {
        $sql = QueryBuilderRepository::buildDeleteQuery(self::DB_TABLE_NAME, $params);

        self::db()->query($sql);
    }
}