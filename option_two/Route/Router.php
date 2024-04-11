<?php

namespace Route;

use App\Contracts\ContactInterface;
use App\Contracts\ContactRepositoryInterface;

class Router
{
    private array $routes = [];
    private ContactRepositoryInterface $contactRepo;

    public function __construct(ContactRepositoryInterface $contactRepo, ContactInterface $contact)
    {
        $this->contactRepo = $contactRepo;
        $this->contact = $contact;
    }

    /**
     * @param string $path
     * @param array $callback
     * @return void
     */
    public function get(string $path, array $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }

    /**
     * @param string $path
     * @param array $callback
     * @return void
     */
    public function post(string $path, array $callback): void
    {
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * @param string $path
     * @param array $callback
     * @return void
     */
    public function delete(string $path, array $callback): void
    {
        $this->routes['DELETE'][$path] = $callback;
    }

    /**
     * @return void
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'];
        $path = parse_url($path, PHP_URL_PATH);

        if ($method === 'POST' && isset($_POST['_method']) && strtoupper($_POST['_method']) === 'DELETE') {
            $method = 'DELETE';
        }

        if (array_key_exists($method, $this->routes) && array_key_exists($path, $this->routes[$method])) {
            $callback = $this->routes[$method][$path];
            $controller = new $callback[0]($this->contactRepo, $this->contact);
            $methodName = $callback[1];

            if (is_callable([$controller, $methodName])) {
                call_user_func([$controller, $methodName]);
            }
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}

?>