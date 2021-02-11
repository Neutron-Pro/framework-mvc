<?php
require __DIR__ . '/../NeutronStars/Core/Loader.php';
use NeutronStars\Core\Loader;
Loader::load();

use NeutronStars\Core\Kernel;
use NeutronStars\Core\Router\Router;

Kernel::create(new Router($_SERVER['REQUEST_URI'] ?? '404'));
require __DIR__ . '/../config/routes.php';

Kernel::get()->handle();
