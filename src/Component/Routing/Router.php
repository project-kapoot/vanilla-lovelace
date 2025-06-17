<?php

namespace App\Component\Routing;

class Router
{
    private array $routes = [];

    public function __construct(
        private readonly string $requestMethod,
        private readonly string $requestPath,
    ){}

    public function add(string $name, array $requestMethods, string $path, string $controller, string $controllerMethod): Route
    {
        $path = $this->normalizePath($path);

        $pattern = '/^' . str_replace('/', '\/', $path) . '$/';

        $isCurrent = in_array($this->requestMethod, $requestMethods) && preg_match($pattern, $this->requestPath, $params) === 1;

        $route = new Route($name, $path, array_values($requestMethods), $controller, $controllerMethod, array_slice($params, 1, null), $isCurrent);

        $this->routes[$name] = $route;

        return $route;
    }

    public function get(string $name): ?Route
    {
        return $this->routes[$name] ?? null;
    }

    public function normalizePath(string $path): string
    {
        return str_starts_with($path, '/') ? $path : '/' . $path;
    }

    public function getCurrentRoute(): ?Route
    {
        foreach($this->routes as $route) {
            if($route->isCurrent() === true) {
                return $route;
            }
        }

        return null;
    }
}