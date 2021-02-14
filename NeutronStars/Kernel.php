<?php

namespace NeutronStars;

use NeutronStars\Entity\AnonymousUser;
use NeutronStars\Entity\UserInterface;
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
    private ?UserInterface $user = null;

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
            $this->getBlade()->directive('isRoute', function (string $query):string {
                return '<?php if($this->isRoute('.$query.')): ?>';
            });
            $this->getBlade()->directive('classRoute', function (string $query): string {
                return '<?= $this->getClassRoute('.$query.') ?>';
            });
            $this->getBlade()->directive('isConnected', function (): string {
                return '<?php if($this->getUser()->isConnected()): ?>';
            });
            $this->getBlade()->directive('isNotConnected', function (): string {
                return '<?php if(!$this->getUser()->isConnected()): ?>';
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
        $route = $this->router->find($params, $this->getUser());
        if ($route != null) {
            $route->setSelected(true);
            $controller = $route->getController();
            $reflection = new ReflectionMethod($controller, $route->getCallMethod());
            $reflection->invoke($controller, ...$params);
        }
    }

    public function getUser(): UserInterface
    {
        if ($this->user === null) {
            if (!defined('USER_ENTITY') || strlen(USER_ENTITY) === 0) {
                $this->user = new AnonymousUser();
            } else {
                $class = USER_ENTITY;
                $this->user = new $class();
                $this->loadUser();
            }
        }
        return $this->user;
    }

    private function loadUser(): void
    {
        if (empty($_SESSION['user_session'])) {
            $this->user = new AnonymousUser();
            return;
        }

        if(!defined('USER_LOADER') || empty($_SESSION['user_session']['user_timout'])
            || empty($_SESSION['user_session']['user_id'])
            || time() - $_SESSION['user_session']['user_timout'] > (USER_TIMEOUT ?? 84600)
        ) {
            $this->disconnectUser();
            return;
        }
        $class = USER_LOADER;
        if(!(new $class())->loadUser($this->user, $_SESSION['user_session']['user_id'])) {
            $this->disconnectUser();
            return;
        }
        $this->connectUser($_SESSION['user_session']['user_id']);
        $this->user->setConnected(true);
    }

    public function connectUser($id): void
    {
        $_SESSION['user_session'] = [];
        $_SESSION['user_session']['user_id']     = $id;
        $_SESSION['user_session']['user_timout'] = time();
    }

    public function disconnectUser(): void
    {
        unset($_SESSION['user_session']);
        $this->user = new AnonymousUser();
    }
}
