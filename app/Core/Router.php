<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, array $handler): void
    {
        $normalizedPath = $this->normalizePath($path);

        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $normalizedPath,
            'handler' => $handler,
        ];
    }

    public function addRoutes(array $routes): void
    {
        foreach ($routes as $route) {
            if (count($route) !== 3) {
                continue;
            }

            [$method, $path, $handler] = $route;
            $this->add($method, $path, $handler);
        }
    }

    public function dispatch(string $requestUri, string $requestMethod): void
    {
        $path = $this->extractPath($requestUri);
        $method = strtoupper($requestMethod);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                $this->runHandler($route['handler']);
                return;
            }
        }

        http_response_code(404);
        echo "404 - Trang không tồn tại.";
    }

    private function runHandler(array $handler): void
    {
        [$controllerClass, $action] = $handler;

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo "Controller không tồn tại: {$controllerClass}";
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            http_response_code(500);
            echo "Method không tồn tại: {$action}";
            return;
        }

        call_user_func([$controller, $action]);
    }

    private function extractPath(string $requestUri): string
    {
        $path = parse_url($requestUri, PHP_URL_PATH) ?? '/';

        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $baseDir = str_replace('\\', '/', dirname($scriptName));

        if ($baseDir !== '/' && $baseDir !== '.') {
            if (strpos($path, $baseDir) === 0) {
                $path = substr($path, strlen($baseDir));
            }
        }

        return $this->normalizePath($path);
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '') {
            return '/';
        }

        $path = '/' . trim($path, '/');

        return $path === '' ? '/' : $path;
    }
}