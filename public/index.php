<?php
require __DIR__ . '/../NeutronStars/Loader.php';
use NeutronStars\Loader;
Loader::load();

use NeutronStars\Kernel;
use NeutronStars\Router\Router;

Kernel::create(new Router($_SERVER['REQUEST_URI'] ?? '404'));
require __DIR__ . '/../config/routes.php';

Kernel::get()->handle();
