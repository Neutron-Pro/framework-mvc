<?php
use NeutronStars\Kernel;
use NeutronStars\Service\Role;

Kernel::get()->getRouter()
    ->add('home', [
        'path'       => '/',
        'controller' => 'App\\Controller\\DefaultController#home'
    ])
    ->add('contact', [
        'path'       => '/contact',
        'controller' => 'App\\Controller\\DefaultController#contact'
    ])
    ->add('auth', [
        'path'       => '/auth',
        'controller' => 'App\\Controller\\AuthController#index',
        'children'   => [
            'login'  => [
                'path'       => '/login',
                'controller' => 'App\\Controller\\AuthController#login',
                'roles'      => [ Role::ANONYMOUS ]
            ],
            'logout' => [
                'path'       => '/logout',
                'controller' => 'App\\Controller\\AuthController#logout',
                'roles'      => [ Role::USER ]
            ],
            'register'  => [
                'path'       => '/register',
                'controller' => 'App\\Controller\\AuthController#register',
                'roles'      => [ Role::ANONYMOUS ]
            ],
            'confirm'   => [
                'path'       => '/confirm',
                'controller' => 'App\\Controller\\ErrorController#call404',
                'children'   => [
                    'account' => [
                        'path'       => '/account',
                        'controller' => 'App\\Controller\\ErrorController#call404',
                        'children'   => [
                            'account' => [
                                'path'       => '/{id}-{token}',
                                'controller' => 'App\\Controller\\AuthController#confirm',
                                'roles'      => [ Role::ANONYMOUS ],
                                'params'     => [
                                    'id'    => '/[0-9]+/',
                                    'token' => '/[a-zA-Z0-9]+/'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ])
    ->add('users', [
        'path'       => '/users',
        'controller' => 'App\\Controller\\ErrorController#call404',
        'children'   => [
            'profile' => [
                'path'       => '/@me',
                'controller' => 'App\\Controller\\UserController#profile',
                'roles'     => [ Role::USER ]
            ]
        ]
    ])
    ->add('api', [
        'path'       => '/api',
        'controller' => 'App\\Controller\\APIController#index',
        'children'   => [
            'readme' => [
                'path'       => '/readme',
                'controller' => 'App\\Controller\\APIController#readme',
                'methods'    => [ 'GET' ]
            ]
        ]
    ])
    ->add('404', [
        'path'       => '/404',
        'controller' => 'App\\Controller\\ErrorController#call404'
    ]);
