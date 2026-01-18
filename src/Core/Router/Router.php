<?php


namespace Core\Router;

class Router
{
    public static Router $instance;
    private array $routes = [];
   

    public function __construct() {
        self::$instance = $this;
    }

    public function get(string $uri, string $action)
    {
        // Store the route URI in lowercase
        $this->routes['GET'][strtolower($uri)] = $action;
    }

    public function post(string $uri, string $action)
    {
        // Store the route URI in lowercase
        $this->routes['POST'][strtolower($uri)] = $action;
    }

    public function dispatch()
    {
        $uri = strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$uri])) {
            [$controllerName, $methodName] = explode('@', $this->routes[$method][$uri]);

            $controllerClass = "App\\Controllers\\$controllerName";

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();

                if (method_exists($controller, $methodName)) {
                    return $controller->$methodName();
                }
            }
        }

        $controller_class = "App\\Controllers\\NotFoundController";
        $controller = new $controller_class();
        $controller->index();
        return;
    }
}
