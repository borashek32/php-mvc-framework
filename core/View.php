<?php

namespace app\core;

class View
{
  public string $title = '';

  public function renderView($view, $params = [])
  {
    $viewContent   = $this->renderOnlyView($view, $params);
    $layoutContent = $this->layoutContent();
    return str_replace('{{content}}', $viewContent, $layoutContent);
  }

  public function renderContent($viewContent)
  {
    $layoutContent = $this->layoutContent();
    return str_replace('{{content}}', $viewContent, $layoutContent);
  }

  protected function layoutContent()
  {
    $layout = Application::$app->layout;
    if (Application::$app->controller) {
      $layout = Application::$app->controller->layout;
    }
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