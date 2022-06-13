<?php

namespace app\core;

use app\core\Request;
use app\core\Response;
use app\core\Application;

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
      $this->response->setStatusCode(404);
      return $this->renderView('_404');
    }
    if (is_string($callback)) {
      return $this->renderView($callback);
    }
    if (is_array($callback)) {
      Application::$app->controller = new $callback[0]();
      $callback[0] = Application::$app->controller;
    }
    return call_user_func($callback, $this->request);
  }

  public function renderView($view, $params = [])
  {
    $layoutContent = $this->layoutContent();
    $viewContent   = $this->renderOnlyView($view, $params);
    return str_replace('{{content}}', $viewContent, $layoutContent);
  }

  // public function renderContent($viewContent)
  // {
  //   $layoutContent = $this->layoutContent();
  //   return str_replace('{{content}}', $viewContent, $layoutContent);
  // }

  protected function layoutContent()
  {
    $layout = Application::$app->controller->layout;
    ob_start();
    include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
    $out = ob_get_clean();

    return $out;
  }

  protected function renderOnlyView($view, $params)
  {
    foreach ($params as $key => $value) {
      $$key = $value;
    }
    ob_start();
    include_once Application::$ROOT_DIR . "/views/$view.php";
    $out = ob_get_clean();

    return $out;
  }
}