<?php

declare(strict_types=1);

require("postsRoutes.php");
require("authRoutes.php");
require("userRoutes.php");
require("profileRoutes.php");
require("adminRoutes.php");

use Rehor\Myblog\config\RoutingConfig;

use function Rehor\Myblog\routes\postsRoutes\getPostsRoutes;
use function Rehor\Myblog\routes\authRoutes\getAuthRoutes;
use function Rehor\Myblog\routes\userRoutes\getUserRoutes;
use function Rehor\Myblog\routes\profileRoutes\getProfileRoutes;
use function Rehor\Myblog\routes\adminRoutes\getAdminRoutes;

RoutingConfig::useFlight(getPostsRoutes());
RoutingConfig::useFlight(getAuthRoutes());
RoutingConfig::useFlight(getUserRoutes());
RoutingConfig::useFlight(getProfileRoutes());
RoutingConfig::useFlight(getAdminRoutes());