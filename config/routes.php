<?php

use NeutronStars\Kernel;

Kernel::get()->getRouter()
    ->add('home', [
        'path'       => '/',
        'controller' => 'App\\Controller\\HomeController#home'
    ])
    ->add('404', [
        'path'       => '/404',
        'controller' => 'App\\Controller\\ErrorController#call404'
    ]);
