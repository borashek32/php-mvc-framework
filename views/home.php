<?php
use app\core\Application;

$this->title = 'Home';
?>

<?php if (\app\core\Application::isGuest()): ?>
  <h1 class="text-center mt-5">
    Hello, guest!
  </h1>
<?php else: ?>
  <h1 class="text-center mt-5">
    Welcome, 
    <?php echo Application::$app->user->getDisplayName() ?>
  </h1>
<?php endif; ?>
