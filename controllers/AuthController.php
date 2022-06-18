<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Response;
use app\core\Request;
use app\models\User;
use app\models\LoginForm;
use app\core\middlewares\AuthMiddleware;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->registerMiddleware(new AuthMiddleware(['profile']));
  }

  public function login(Request $request, Response $response)
  {
    $loginForm = new LoginForm();
    if ($request->isPost()) {
      $loginForm->loadData($request->getBody());
      if ($loginForm->validate() && $loginForm->login()) {
        $response->redirect('/');
        return;
      }
    }
    $this->setLayout('auth');
    return $this->render('auth/login', [
      'loginForm' => $loginForm
    ]);
  }

  public function register(Request $request)
  {
    $user = new User();
    if ($request->isPost()) {
      $user->loadData($request->getBody());

      if ($user->validate() && $user->save()) {
        Application::$app->session->setFlash('success', 'Thank you for registration');
        Application::$app->response->redirect('/');
        exit;
      }

      return $this->render('auth/register', [
        'model' => $user
      ]);
    }
    $this->setLayout('auth');
    return $this->render('auth/register', [
      'model' => $user
    ]);
  }

  public function logout(Request $request, Response $response)
  {
    Application::$app->logout();
    $response->redirect('/');
  }

  public function profile()
  {
    return $this->render('auth/profile');
  }

// echo '<pre>';
// var_dump($request->getBody());
// echo '</per>';
// exit;
}