<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\DBConnectors\DBConnectorDoctrine;

use Rehor\Myblog\models\DBConnectors\DBConnectorDoctrine\interfaces\DBConnectorDoctrineInterface;
use Rehor\Myblog\models\DBConnectors\DBConnector\DBConnector;
use Rehor\Myblog\config\Config;
use \Doctrine\DBAL\DriverManager;
use \Doctrine\ORM\EntityManager;

final class DBConnectorDoctrine extends DBConnector implements DBConnectorDoctrineInterface
{
    protected static $instance;

    private function __construct($driverConfig, $ormSetup)
    {
        self::$instance = new EntityManager($driverConfig, $ormSetup);
    }

    public static function init(string $dbName): object
    {
        if (is_null(self::$instance)) {
            $config = [
                "driver" => "pdo_mysql",
                "host" => "localhost:5600",
                "user" => "root",
                "password" => "root",
                "dbname" => $dbName
            ];
            
            $ormSetup = Config::setDoctrine();
            $driverConfig = DriverManager::getConnection($config, $ormSetup);
            
            new self($driverConfig, $ormSetup);
        }
        
        return self::$instance;
    }
    
    public static function requestRepository(string $dbName, string $className): object
    {
        return self::init($dbName)->getRepository($className);
    }
    
    public static function retrieveOneFromRepository(string $dbName, string $className, array $params): ?object
    {
        return self::requestRepository($dbName, $className)->findOneBy($params);
    }

    public static function retrieveAllFromRepository(string $dbName, string $className): ?array
    {
        return self::requestRepository($dbName, $className)->findAll();
    }
    
    public static function insertIntoRepository(string $dbName, object $class): void
    {
        self::init($dbName)->persist($class);
        self::init($dbName)->flush();
    }
    
    public static function updateInRepository(string $dbName, object $class): void
    {
        self::init($dbName)->merge($class);
        self::init($dbName)->flush();
    }
    
    public static function removeRepository(string $dbName, object $class): void
    {
        self::init($dbName)->remove($class);
        self::init($dbName)->flush();
    }
}