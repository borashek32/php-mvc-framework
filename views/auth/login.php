<?php
/**
 * @var $loginForm \app\models\LoginForm
 */
$this->title = 'Login';
?>

<h1 class="text-center mt-5">Login</h1>

  <div class="col-md-4 offset-md-4">
    <?php $form = \app\core\form\Form::begin('', "post") ?>
      <?php echo $form->field($loginForm, 'email') ?>
      <?php echo $form->field($loginForm, 'password')->passwordField() ?>

      <button type="submit" class="btn btn-outline-primary">Login</button>
    <?php \app\core\form\Form::end() ?>
  </div>
</div>
