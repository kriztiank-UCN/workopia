<?php

namespace Framework;

use App\Controllers\ErrorController;

/**
 * Router for the application
 */
class Router
{
  protected $routes = [];

  /**
   * Add a route to the router
   *
   * @param string $method
   * @param string $uri
   * @param string $action
   * @return void
   */
  public function registerRoute($method, $uri, $action)
  {
    // list function, like js destructuring
    list($controller, $controllerMethod) = explode('@', $action);
    // inspectAndDie($controller);

    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'controllerMethod' => $controllerMethod
    ];
  }

  /**
   * Add a GET route
   * 
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function get($uri, $controller)
  {
    $this->registerRoute('GET', $uri, $controller);
  }

  /**
   * Add a POST route
   * 
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function post($uri, $controller)
  {
    $this->registerRoute('POST', $uri, $controller);
  }

  /**
   * Add a PUT route
   * 
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function put($uri, $controller)
  {
    $this->registerRoute('PUT', $uri, $controller);
  }

  /**
   * Add a DELETE route
   * 
   * @param string $uri
   * @param string $controller
   * @param array $middleware
   * @return void
   */
  public function delete($uri, $controller)
  {
    $this->registerRoute('DELETE', $uri, $controller);
  }

  /**
   * Route the request
   * 
   * @param string $uri
   * @param string $method
   * @return void
   */
  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      // if the uri and method match, load the controller
      if ($route['uri'] === $uri && $route['method'] === $method) {
        // Extract the controller and method
        $controller = "App\\Controllers\\{$route['controller']}";
        $controllerMethod = $route['controllerMethod'];

        // Intantiate the controller
        $controllerInstance = new $controller();
        // Call the method
        $controllerInstance->$controllerMethod();
        return;
      }
    }
    // Use the Scope Resolution Operator (::) to access the static method
    // https://www.php.net/manual/en/language.oop5.paamayim-nekudotayim.php
    ErrorController::notFound();
  }
}
