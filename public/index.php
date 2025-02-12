<?php

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// to know the root directory of the project
// echo '<pre>';
// var_dump(dirname(__DIR__));
// echo '<pre>';
// exit;

$config = [
  'userClass' => \app\models\User::class,
  'db' => [
    'dsn'          => $_ENV['DB_DSN'],
    'user'         => $_ENV['DB_USER'],
    'password'     => $_ENV['DB_PASSWORD']
  ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);

// Auth routes
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

// Personal dashboard
$app->router->get('/profile', [AuthController::class, 'profile']);

$app->run();