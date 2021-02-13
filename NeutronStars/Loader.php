<?php

namespace NeutronStars;

class Loader
{
    public static function load(): void
    {
        spl_autoload_register(function ($class) {
            if (strpos($class, 'NeutronStars') === 0) {
                require str_replace('\\', DIRECTORY_SEPARATOR, '..'. DIRECTORY_SEPARATOR . $class) . '.php';
            } else {
                require str_replace('\\', DIRECTORY_SEPARATOR, '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR . $class) . '.php';
            }
        });
        require __DIR__ . DIRECTORY_SEPARATOR . '..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';
    }
}
