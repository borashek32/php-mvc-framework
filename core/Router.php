<?php

namespace app\core;

use app\core\Request;
use app\core\Response;
use app\core\Application;
use app\core\exceptions\NotFoundException;

class Router
{
  public Request $request;
  protected array $routes = [];
  public Response $response;
  public $viewContent;

  public function __construct(Request $request, Response $response)
  {
    $this->request  = $request;
    $this->response = $response;
  }

  // function to get a path from the $_SERVER superglobal
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
    $path       = $this->request->getPath();
    $method     = $this->request->method();
    $callback   = $this->routes[$method][$path] ?? false;

    if ($callback === false) {
      throw new NotFoundException();
    }
    if (is_string($callback)) {
      return Application::$app->view->renderView($callback);
    }
    if (is_array($callback)) {
      /**
       * @var \app\core\Controller $controller
       */
      $controller = new $callback[0]();
      Application::$app->controller = $controller;
      $controller->action = $callback[1];
      $callback[0] = $controller;

      foreach ($controller->getMiddlewares() as $middleware) {
        $middleware->execute();
      }
    }
    return call_user_func($callback, $this->request, $this->response);
  }

  public function renderView($view, $params = [])
  {
    return Application::$app->view->renderView($view, $params);
  }
}