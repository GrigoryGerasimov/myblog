<?php

declare(strict_types=1);

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

header("Content-type: text/html; charset=utf-8");

require("../vendor/autoload.php");
require("routes/routes.php");

use Rehor\Myblog\config\Config;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;

SessionRepository::initSession();

Config::setDoctrine();
Config::setFlight();