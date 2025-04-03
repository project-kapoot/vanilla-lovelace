<?php

class Request
{
    public function __construct(
        private string $method,
        private string $uri,
        private string $protocol,
        private array $headers,
        private string $body,
    ){}

    public function getMethod() : string
    {
        return $this->method;
    }

    public function getUri() : string
    {
        return $this->uri;
    }

    public function getProtocol() : string
    {
        return $this->protocol;
    }

    public function getHeader(string $name) : ?string
    {
        return $this->headers[$name] ?? null;
    }

    public function getHeaders() : array
    {
        return $this->headers;
    }

    public function getBody() : string
    {
        return $this->body;
    }

    public static function parseFromString(string $request) : self
    {
        $lines = explode("\n", $request);
        
        [$method, $uri, $protocol] = explode(' ', $lines[0]);
        
        $headers = [];
        for($i = 1; $i < count($lines); $i++) {
            $parts = explode(': ', $lines[$i], 2);

            if(count($parts) === 2) {
                $headers[$parts[0]] = trim($parts[1]);
            }
        }

        return new self(
            $method,
            $uri,
            $protocol,
            $headers,
            '',
        );
    }
}