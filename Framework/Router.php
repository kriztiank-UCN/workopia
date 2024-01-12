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
  public function route($uri)
  {
    // Get HTTP method with the superglobal $_SERVER
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    // inspect($requestMethod);

    foreach ($this->routes as $route) {

      // Split the current URI into segments (explode will turn a string into an array)
      $uriSegments = explode('/', trim($uri, '/'));
      // inspectAndDie($uriSegments);

      // Split the route URI into segments
      $routeSegments = explode('/', trim($route['uri'], '/'));

      $match = true;

      // Check if the number of segments matches
      if (count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $requestMethod)) {
        $params = [];

        // Loop trough the route segments 
        for ($i = 0; $i < count($uriSegments); $i++) {
          // If the uri's do not match and there is no param (reg expression '/\{(.+?)\}/' is looking for text inside parenthesis)
          if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
            $match = false;
            break;
          }

          // Check for the param and add to $params array
          // $matches is the key of the array, $uriSegments[$i] is the value
          if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
            // inspectAndDie($uriSegments[$i]);
            $params[$matches[1]] = $uriSegments[$i];
            // inspectAndDie($params);
          }
        }

        // if the uri and method match, load the controller
        if ($match) {
          // Extract the controller and method
          $controller = "App\\Controllers\\{$route['controller']}";
          $controllerMethod = $route['controllerMethod'];

          // Intantiate the controller
          $controllerInstance = new $controller();
          // Call the method
          $controllerInstance->$controllerMethod($params);
          return;
        }
      }
    }
    // Use the Scope Resolution Operator (::) to access the static method
    // https://www.php.net/manual/en/language.oop5.paamayim-nekudotayim.php
    ErrorController::notFound();
  }
}
