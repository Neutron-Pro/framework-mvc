<?php

namespace NeutronStars;

class Loader
{
    public static function load(): void
    {
        require __DIR__ . '/../config/config.php';
        spl_autoload_register(function ($class) {
            if (strpos($class, 'NeutronStars') === 0) {
                require str_replace('\\', '/', '../' . $class) . '.php';
            } else {
                require str_replace('\\', '/', '../src/' . $class) . '.php';
            }
        });
    }
}
