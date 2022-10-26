<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Application;
use app\core\Response;
use app\core\Request;
use app\models\ContactForm;

class SiteController extends Controller
{
  public function home()
  {
    return $this->render('home');
  }

  public function contact(Request $request, Response $response)
  {
    $contactForm = new ContactForm();
    if ($request->isPost()) {
      $contactForm->loadData($request->getBody());
      if ($contactForm->validate() && $contactForm->send()) {
        Application::$app->session->setFlash('success', 'Thanks for contacting us! Your message sent successufully');
        return $response->redirect('/contact');
      }
    }
    return $this->render('contact', [
      'model' => $contactForm
    ]);
  }
// echo '<pre>';
// var_dump($body);
// echo '</pre>';
// exit;
}