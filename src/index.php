<?php

declare(strict_types=1);
error_reporting(E_ALL);

header("Content-type: text/html; charset=utf-8");

include "../vendor/autoload.php";


$twigLoader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__)."/views");
$twigConfig = array(
    "debug" => true
);

Flight::register("view", "\Twig\Environment", array($twigLoader, $twigConfig), function($twig) {
    $twig->addExtension(new \Twig\Extension\DebugExtension());
});

Flight::path(dirname(__FILE__)."/controllers");
Flight::path(dirname(__FILE__)."/models");

require("routes.php");

Flight::start();