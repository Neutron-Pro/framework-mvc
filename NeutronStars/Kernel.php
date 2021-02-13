<?php

namespace NeutronStars;

use NeutronStars\Router\Router;
use NeutronStars\Database\Database;
use NeutronStars\View\Blade\BladeOne;

use ReflectionException;
use ReflectionMethod;

class Kernel
{
    private static ?Kernel $instance = null;
    public static function get(): Kernel
    {
        return self::$instance;
    }

    public static function create(Router $router): void
    {
        self::$instance = new self($router);
    }

    private Router $router;
    private ?Database $database = null;
    private ?BladeOne $bladeOne = null;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    final public function getRouter(): Router
    {
        return $this->router;
    }

    final public function getDatabase(): Database
    {
        if ($this->database === null) {
            $this->database = new Database(DB_NAME, [
                'url'      => DB_HOST,
                'port'     => DB_PORT,
                'user'     => DB_USER,
                'password' => DB_PASSWORD,
                'charset'  => DB_CHARSET
            ]);
        }
        return $this->database;
    }

    public function getBlade(): BladeOne
    {
        if ($this->bladeOne === null) {
            $this->bladeOne = new BladeOne([VIEWS, LAYOUTS], BLADE_CACHE);
            $this->bladeOne->directive('router', function (string $query): string {
                return '<?= $this->getRoute(' . $query . ') ?>';
            });
        }
        return $this->bladeOne;
    }

    /**
     * @throws ReflectionException if the object parameter does not contain an
     * instance of the class that this method was declared in or the method
     * invocation failed.
     */
    final public function handle(): void
    {
        $route = $this->router->find($params);
        if ($route != null) {
            $reflection = new ReflectionMethod($route->getController(), $route->getCallMethod());
            $reflection->invoke($route->getController(), ...$params);
        }
    }
}
