<?php

namespace App\Component\Routing;

class Route
{
    public function __construct(
        private readonly string $name,
        private readonly string $path,
        private readonly array $requestMethods,
        private readonly string $controller,
        private readonly string $controllerMethod,
        private readonly array $params,
        private readonly bool $isCurrent,
    ){}

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getRequestMethods(): array
    {
        return $this->requestMethods;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getControllerMethod(): string
    {
        return $this->controllerMethod;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getParam(string|int $key): ?string
    {
        return $this->params[$key] ?? null;
    }

    public function isCurrent(): bool
    {
        return $this->isCurrent;
    }
}