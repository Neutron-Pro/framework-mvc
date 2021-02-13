<?php
use NeutronStars\Loader;
use NeutronStars\Kernel;
use NeutronStars\Router\Router;
require __DIR__ . '/../NeutronStars/Loader.php';
Loader::load();
Kernel::create(new Router($_SERVER['REQUEST_URI'] ?? '404', BASE_PATH));
require __DIR__ . '/../config/routes.php';
Kernel::get()->handle();
