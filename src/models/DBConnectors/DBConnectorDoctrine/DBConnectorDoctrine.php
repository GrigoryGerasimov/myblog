<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\DBConnectors\DBConnectorDoctrine;

use Rehor\Myblog\models\DBConnectors\DBConnectorDoctrine\interfaces\DBConnectorDoctrineInterface;
use Rehor\Myblog\config\Config;
use \Doctrine\DBAL\DriverManager;
use \Doctrine\ORM\EntityManager;

class DBConnectorDoctrine implements DBConnectorDoctrineInterface
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
    
    public static function insertIntoRepository(string $dbName, object $class): void
    {
        self::init($dbName)->persist($class);
        self::init($dbName)->flush();
    }
}