<?php
use NeutronStars\Kernel;

Kernel::get()->getRouter()
    ->add('home', [
        'path'       => '/',
        'controller' => 'App\\Controller\\HomeController#home'
    ])
    ->add('users', [
        'path'       => '/users',
        'controller' => 'App\\Controller\\UserController#users',
        'children'   => [
            'user' => [
                'path' => '/{id}',
                'controller' => 'App\\Controller\\UserController#user',
                'params' => [
                    'id' => '/[0-9]+/'
                ]
            ]
        ]
    ])
    ->add('404', [
        'path'       => '/404',
        'controller' => 'App\\Controller\\ErrorController#call404'
    ]);
