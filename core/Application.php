<?php

namespace app\core;

use app\core\Router;
use app\core\Request;
use app\core\Response;

class Application
{
  public static string $ROOT_DIR; // to handle the path to a root directory
  public Request $request;
  public Response $response;
  public Router $router;
  public Controller $controller;
  public static Application $app;

  public function __construct($rootPath)
  {
    self::$ROOT_DIR = $rootPath;
    self::$app      = $this;
    $this->request  = new Request();
    $this->response = new Response();
    $this->router   = new Router($this->request, $this->response);
  }

  public function run()
  {
    echo $this->router->resolve();
  }

  /**
   * @return app/core/Controller
   */
  public function getController(): \app\core\Controller
  {
    return $this->controller;
  }

  /**
   * @return app/core/Controller $controller
   */
  public function setController(\app\core\Controller $controller): void
  {
    $this->controller = $controller;
  }
}