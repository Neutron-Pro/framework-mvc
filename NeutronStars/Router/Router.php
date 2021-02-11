<?php
namespace NeutronStars\Router;

class Router
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    private string $path;

    public function __construct(string $path)
    {
        if(mb_strlen($path) > 1){
            $path = trim(rtrim($path, '/'));
        }
        $this->path = $path;
    }

    public function add(string $name, array $route): self
    {
        $route = $this->createRecursive($name, $route);
        $this->routes[$route->getName()] = $route;
        return $this;
    }
    private function createRecursive($name, array $array): Route
    {
        $controllerInfo = explode('#', $array['controller']);
        $route = new Route($name, $array['path'], new $controllerInfo[0], $controllerInfo[1], $array['params'] ?? []);
        foreach (($array['children'] ?? []) as $key => $value ){
            $route->add($this->createRecursive($key, $value));
        }
        return $route;
    }

    public function find(&$params): ?Route
    {
        if($params == null){
            $params = [];
        }
        foreach ($this->routes as $route){
            $checkRoute = $route->get($this->path, $params);
            if($checkRoute != null){
                return $checkRoute;
            }
        }
        return $this->routes['404'];
    }

    public function get(string $name, array $params = []): string
    {
        $split = explode('.', $name);
        if(!empty($this->routes[$split[0]])){
            $build = $this->routes[$split[0]]->buildPath(array_slice($split, 1), $params);
            if($build != null){
                return $build;
            }
        }
        return '/';
    }
}
