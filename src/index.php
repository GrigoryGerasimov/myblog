<?php

declare(strict_types=1);
error_reporting(E_ALL);

include "../vendor/autoload.php";

use Rehor\Myblog\controllers\RouterController\RouterController;
use Rehor\Myblog\routers\BramusRouter\BramusRouter;
use Rehor\Myblog\routers\CustomRouter\CustomRouter;
use Rehor\Myblog\routers\FlightRouter\FlightRouter;

$router = new RouterController();

// $router->register(new BramusRouter())->useGet("/", function() {
//     echo "Got Main from BramusRouter";
// })->useGet("/about", function() {
//     echo "Got About from BramusRouter";
// });

$router->register(new FlightRouter())->useGet($_SERVER["REQUEST_URI"]);