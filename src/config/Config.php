<?php

declare(strict_types=1);

namespace Rehor\Myblog\config;

class Config
{
    public static function setTwig()
    {
        $twigLoader = new \Twig\Loader\FilesystemLoader("views");
        $twigConfig = array(
            "debug" => true
        );
        
        return [
            "twigLoader" => $twigLoader,
            "twigConfig" => $twigConfig
        ];
    }
    
    public static function setFlight()
    {
        extract(self::setTwig(), EXTR_PREFIX_IF_EXISTS, "flght");

        \Flight::register("view", "\Twig\Environment", array($twigLoader, $twigConfig), function($twig) {
            $twig->addExtension(new \Twig\Extension\DebugExtension());
        });
            
        \Flight::path("controllers");
        \Flight::path("models");
        \Flight::path("repositories");
        
        \Flight::start();
    }
    
    public static function setDoctrine()
    {        
        $path = ["entities"];
        $isDevMode = false;
        
        $config = [
            "driver" => "pdo_mysql",
            "host" => "localhost:5600",
            "user" => "root",
            "password" => "root",
            "dbname" => "myblog"
        ];
        
        $ormSetupConfig = \Doctrine\ORM\ORMSetup::createAttributeMetadataConfiguration($path, $isDevMode);
        $driverConnection = \Doctrine\DBAL\DriverManager::getConnection($config, $ormSetupConfig);
        $GLOBALS["entityManager"] = new \Doctrine\ORM\EntityManager($driverConnection, $ormSetupConfig);
    }
}