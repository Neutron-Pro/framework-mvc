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
    ->add('api', [
        'path'       => '/api',
        'controller' => 'App\\Controller\\APIController#index',
        'children'   => [
            'readme' => [
                'path'       => '/readme',
                'controller' => 'App\\Controller\\APIController#readme'
            ]
        ]
    ])
    ->add('404', [
        'path'       => '/404',
        'controller' => 'App\\Controller\\ErrorController#call404'
    ]);
