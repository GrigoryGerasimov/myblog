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
        
        return \Doctrine\ORM\ORMSetup::createAttributeMetadataConfiguration($path, $isDevMode);
    }
    
    public static function setPHPAuth(string $dbName)
    {
        $db = new \PDO("mysql:dbname=$dbName;host=localhost:6500", "root", "root");
        
        return new \Delight\Auth\Auth($db);
    }
}