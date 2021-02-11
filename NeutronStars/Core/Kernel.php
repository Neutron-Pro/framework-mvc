<?php
namespace NeutronStars\Core;
use NeutronStars\Core\Router\Router;
use ReflectionMethod;

class Kernel
{
    private static $instance = null;

    public static function get(): Kernel
    {
        return self::$instance;
    }

    public static function create(Router $router): void
    {
        self::$instance = new self($router);
    }

    private Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function handle(): void
    {
        $route = $this->router->find($params);
        if($route != null){
            $reflection = new ReflectionMethod($route->getController(), $route->getCallMethod());
            $reflection->invoke($route->getController(), ...$params);
        }
    }
}
