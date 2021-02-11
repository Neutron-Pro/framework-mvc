<?php
namespace NeutronStars\Router;
use NeutronStars\Controller\Controller;

class Route
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    private Controller $controller;
    private string $callMethod;
    private string $name;
    private string $path;
    private array $params;

    public function __construct(string $name, string $path, Controller $controller, string $callMethod, array $params)
    {
        $this->name = $name;
        $this->path = $path;
        $this->controller = $controller;
        $this->callMethod = $callMethod;
        $this->params = $params;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function getCallMethod(): string
    {
        return $this->callMethod;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function add(Route $route)
    {
        $this->routes[$route->getName()] = $route;
    }

    public function get($path, array &$params): ?Route
    {
        if($this->path === $path){
            return $this;
        }
        if(count($this->params) > 0){
            $hash = explode('/', ltrim($path, '/'))[0];
            $hashFormat = $hash;
            $pathFormat = $this->path;
            $buildParams = $params;
            foreach ($this->params as $key => $value){
                preg_match($value, $hashFormat, $content);
                if(!empty($content[0])){
                    $pathFormat = str_replace('{'.$key.'}', $content[0], $pathFormat);
                    $hashFormat = substr_replace($hashFormat, '', strpos($hashFormat, $content[0]), strlen($content[0]));
                    $buildParams[] = $content[0];
                }else{
                    return null;
                }
            }
            if('/'.$hash === $pathFormat){
                $params = $buildParams;
                if(count(explode('/', ltrim($path, '/'))) === 1){
                    return $this;
                }
                $path = substr_replace($path, '', 0, strlen('/'.$hash));
                foreach ($this->routes as $route){
                    $checkRoute = $route->get($path, $params);
                    if($checkRoute != null){
                        return $checkRoute;
                    }
                }
            }
            return null;
        }
        if(strpos($path, $this->path) === 0){
            $path = substr_replace($path, '', 0, strlen($this->path));
            foreach ($this->routes as $route){
                $checkRoute = $route->get($path, $params);
                if($checkRoute != null){
                    return $checkRoute;
                }
            }
        }
        return null;
    }

    public function buildPath(array $names = [], array $params = []): ?string
    {
        $path = $this->path;
        foreach ($this->params as $key => $value){
            if(!empty($params[$key])){
                $path = str_replace('{'.$key.'}', $params[$key], $path);
            }else{
                return null;
            }
        }
        if(count($names) > 0){
            $build = null;
            if(!empty($this->routes[$names[0]])){
                $build = $this->routes[$names[0]]->buildPath(array_slice($names, 1), $params);
            }
            if($build == null){
                return null;
            }
            $path .= $build;
        }
        return $path;
    }
}
