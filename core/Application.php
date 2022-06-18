<?php

namespace app\core;

use app\core\Router;
use app\core\Request;
use app\core\Session;
use app\core\Response;
use app\core\Controller;
use app\core\Database;
use app\core\DbModel;

class Application
{
  public string $layout = 'main';
  public string $userClass;
  public static string $ROOT_DIR; // to handle the path to a root directory
  public Request $request;
  public Response $response;
  public Database $db;
  public Router $router;
  public ?Controller $controller = null;
  public Session $session;
  public static Application $app;
  public ?DbModel $user;

  public function __construct($rootPath, array $config)
  {
    $this->userClass = $config['userClass'];

    self::$ROOT_DIR = $rootPath;
    self::$app      = $this;
    
    $this->request  = new Request();
    $this->response = new Response();
    $this->router   = new Router($this->request, $this->response);
    $this->db       = new Database($config['db']);
    $this->session  = new Session;

    $primaryValue = $this->session->get('user');
    if ($primaryValue) {
      $primaryKey   = $this->userClass::primaryKey();
      $this->user   = $this->userClass::findOne([$primaryKey => $primaryValue]);
    } else {
      $this->user = null;
    }
  }

  public function run()
  {
    try {
      echo $this->router->resolve();
    } catch (\Exception $e) {
      echo $this->router->renderView('_error' , [
        'exception' => $e
      ]);
    }
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

  public function login(DbModel $user)
  {
    $this->user   = $user;
    $primaryKey   = $user->primaryKey();
    $primaryValue = $user->{$primaryKey};
    Application::$app->session->set('user', $primaryValue);
    // $this->user   = $user;
    // $className = get_class($user);
    // $primaryKey = $className::primaryKey();
    // $value = $user->{$primaryKey};
    // Application::$app->session->set('user', $value);

    return true;
  }

  public function logout()
  {
    $this->user = null;
    $this->session->remove('user');
    session_destroy();
  }

  public static function isGuest()
  {
    return !self::$app->user;
  }
}