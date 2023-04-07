<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\DBController;

use Rehor\Myblog\controllers\DBController\interfaces\DBControllerInterface;
use Rehor\Myblog\controllers\DBController\traits\DBControllerTrait;
use Rehor\Myblog\repositories\QueryBuilderRepository\QueryBuilderRepository;
use Rehor\Myblog\repositories\DBConnectorRepositories\DBConnectorFlightRepository\DBConnectorFlightRepository;

final class DBController implements DBControllerInterface
{
    use DBControllerTrait;
    
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
        list($updParams, $extractedParamsValue) = self::prepareParams($params);
        
        $sql = QueryBuilderRepository::buildSelectQuery(self::DB_TABLE_NAME, $updParams);
        
        $queryStatement = self::db()->prepare($sql);
        
        if (!is_null($extractedParamsValue)) {
            
            $queryStatement->bind_param("s", $extractedParamsValue[key($extractedParamsValue)]);
            
        }
        
        $queryStatement->execute();
        
        return $queryStatement->get_result();
    }

    public static function insert(object $data): void
    {
        list($dataArray, $extractedDataValue) = self::prepareData($data);
        
        $sql = QueryBuilderRepository::buildInsertQuery(self::DB_TABLE_NAME, $dataArray);

        $queryStatement = self::db()->prepare($sql);
        
        if (!is_null($extractedDataValue)) {
            
            extract($extractedDataValue, EXTR_SKIP);
            
            $queryStatement->bind_param("ssss", $title, $author, $text, $filepath);
            
        }
        
        $queryStatement->execute();
    }
    
    public static function update(?array $params, object $data): object
    {
        list($updParams, $extractedParamsValue) = self::prepareParams($params);
        
        list($dataArray, $extractedDataValue) = self::prepareData($data);
        
        $sql = QueryBuilderRepository::buildUpdateQuery(self::DB_TABLE_NAME, $updParams, $dataArray);

        $queryStatement = self::db()->prepare($sql);
        
        if (!is_null($extractedParamsValue) && !is_null($extractedDataValue)) {
            
            extract($extractedDataValue, EXTR_SKIP);
            
            $queryStatement->bind_param("sssss", $title, $author, $text, $filepath, $extractedParamsValue[key($extractedParamsValue)]);
            
        }
        
        $queryStatement->execute();
        
        return self::select($params);
    }
    
    public static function delete(array $params): void
    {
        list($updParams, $extractedParamsValue) = self::prepareParams($params);
        
        $sql = QueryBuilderRepository::buildDeleteQuery(self::DB_TABLE_NAME, $updParams);

        $queryStatement = self::db()->prepare($sql);
        
        if (!is_null($extractedParamsValue)) {
            
            $queryStatement->bind_param("s", $extractedParamsValue[key($extractedParamsValue)]);
            
        }
        
        $queryStatement->execute();
        
    }
}