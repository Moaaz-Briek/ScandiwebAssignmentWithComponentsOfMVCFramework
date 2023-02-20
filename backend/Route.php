<?php
class Route
{
    private array $routes = [];
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
           throw new NotFoundException();
        }
        if (is_array($callback)) {
            $controller = new $callback[0]($this->request);
            $callback[0] = $controller;
            return call_user_func($callback, $this->request);
        }
    }
};