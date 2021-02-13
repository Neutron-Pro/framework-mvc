<?php

use NeutronStars\Kernel;

Kernel::get()->getRouter()
    ->add('home', [
        'path'       => '/',
        'controller' => 'App\\Controller\\DefaultController#home'
    ])
    ->add('contact', [
        'path'       => '/contact',
        'controller' => 'App\\Controller\\DefaultController#contact'
    ])
    ->add('404', [
        'path'       => '/404',
        'controller' => 'App\\Controller\\ErrorController#call404'
    ]);
