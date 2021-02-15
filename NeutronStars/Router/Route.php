<?php

namespace NeutronStars\Router;

use NeutronStars\Controller\Controller;
use NeutronStars\Entity\UserInterface;

class Route
{
    /**
     * @var Route[]
     */
    private array $routes = [];
    private string $controller;
    private string $callMethod;
    private string $name;
    private string $path;
    private array $params;
    private array $roles;
    private array $methods;

    private bool $selected = false;

    public function __construct(string $name, string $path, string $controller,
                                ?string $callMethod, array $params, array $roles, array $methods)
    {
        $this->name = $name;
        $this->path = $path;
        $this->controller = $controller;
        $this->callMethod = $callMethod ?? 'index';
        $this->params = $params;
        $this->roles = $roles;
        $this->methods = $methods;
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
        return new $this->controller();
    }

    public function getCallMethod(): string
    {
        return $this->callMethod;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function isSelected(): bool
    {
        return $this->selected;
    }

    public function setSelected(bool $selected): void
    {
        $this->selected = $selected;
    }

    public function add(Route $route)
    {
        $this->routes[$route->getName()] = $route;
    }

    public function get($path, array &$params, UserInterface $user): ?Route
    {
        if ($this->path === $path) {
            if (
                (empty($this->roles) || $user->hasRoles(...$this->roles))
                &&
                (empty($this->methods) || in_array($_SERVER['REQUEST_METHOD'], $this->methods))
            ) {
                return $this;
            }
            return null;
        }
        if (count($this->params) > 0) {
            $hash = explode('/', ltrim($path, '/'))[0];
            $hashFormat = $hash;
            $pathFormat = $this->path;
            $buildParams = $params;
            foreach ($this->params as $key => $value) {
                preg_match($value, $hashFormat, $content);
                if (!empty($content[0])) {
                    $pathFormat = str_replace('{' . $key . '}', $content[0], $pathFormat);
                    $hashFormat = substr_replace(
                        $hashFormat,
                        '',
                        strpos($hashFormat, $content[0]),
                        strlen($content[0])
                    );
                    $buildParams[] = $content[0];
                } else {
                    return null;
                }
            }
            if ('/' . $hash === $pathFormat) {
                $params = $buildParams;
                if (count(explode('/', ltrim($path, '/'))) === 1) {
                    if (
                        (empty($this->roles) || $user->hasRoles(...$this->roles))
                        &&
                        (empty($this->methods) || in_array($_SERVER['REQUEST_METHOD'], $this->methods))
                    ) {
                        return $this;
                    }
                    return null;
                }
                $path = substr_replace($path, '', 0, strlen('/' . $hash));
                foreach ($this->routes as $route) {
                    $checkRoute = $route->get($path, $params, $user);
                    if ($checkRoute != null) {
                        return $checkRoute;
                    }
                }
            }
            return null;
        }
        if (strpos($path, $this->path) === 0) {
            $path = substr_replace($path, '', 0, strlen($this->path));
            foreach ($this->routes as $route) {
                $checkRoute = $route->get($path, $params, $user);
                if ($checkRoute != null) {
                    return $checkRoute;
                }
            }
        }
        return null;
    }

    public function buildPath(array $names = [], array $params = []): ?string
    {
        $path = $this->path;
        foreach ($this->params as $key => $value) {
            if (!empty($params[$key])) {
                $path = str_replace('{' . $key . '}', $params[$key], $path);
            } else {
                return null;
            }
        }
        if (count($names) > 0) {
            $build = null;
            if (!empty($this->routes[$names[0]])) {
                $build = $this->routes[$names[0]]->buildPath(array_slice($names, 1), $params);
            }
            if ($build == null) {
                return null;
            }
            $path .= $build;
        }
        return $path;
    }

    private function hasSelected(): bool
    {
        if(!$this->selected) {
            foreach ($this->routes as $route) {
                if ($route->hasSelected()) {
                    return true;
                }
            }
        }
        return $this->selected;
    }

    public function isRoute(array $name, bool $strict = true): bool
    {
        if (empty($name)) {
            $selected = $this->selected;
            if (!$selected && !$strict) {
                $selected = $this->hasSelected();
            }
            return $selected;
        }
        if (!empty($this->routes[$name[0]])) {
            return $this->routes[$name[0]]->isRoute(array_slice($name, 1), $strict);
        }
        return false;
    }
}
