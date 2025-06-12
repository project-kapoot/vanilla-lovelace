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
        $route = new Route($name, $path, array_values($requestMethods), $controller, $controllerMethod);

        $this->routes[$name] = $route;

        return $route;
    }

    public function get(string $name): ?Route
    {
        return $this->routes[$name] ?? null;
    }

    public function isCurrentRoute(Route $route): bool
    {
        $requestMethods = $route->getRequestMethods();

        return in_array($this->requestMethod, $requestMethods, true) && $this->requestPath === $route->getPath();
    }

    public function getCurrentRoute(): ?Route
    {
        foreach($this->routes as $route) {
            if($this->isCurrentRoute($route)) {
                return $route;
            }
        }

        return null;
    }
}