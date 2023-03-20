<?php

declare(strict_types=1);
error_reporting(E_ALL);

include "../vendor/autoload.php";

use Rehor\Myblog\controllers\RouterController\RouterController;
use Rehor\Myblog\routers\BramusRouter\BramusRouter;
use Rehor\Myblog\routers\CustomRouter\CustomRouter;
use Rehor\Myblog\routers\FlightRouter\FlightRouter;
use Rehor\Myblog\routers\IzniburakRouter\IzniburakRouter;

$router = new RouterController();

$router->register(new BramusRouter())->useGet($_SERVER["REQUEST_URI"]);