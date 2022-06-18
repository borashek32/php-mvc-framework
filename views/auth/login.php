<?php
/**
 * @var $loginForm \app\models\LoginForm
 */
?>

<h1 class="text-center mt-5">Login</h1>

  <div class="col-md-4 offset-md-4">
    <?php $form = \app\core\form\Form::begin('', "post") ?>
      <?php echo $form->field($loginForm, 'email') ?>
      <?php echo $form->field($loginForm, 'password')->passwordField() ?>

      <button type="submit" class="btn btn-outline-primary">Login</button>
    <?php \app\core\form\Form::end() ?>
  </div>

  <!-- <form action="" method="POST">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control">
    </div>
    
    <button type="submit" class="btn btn-primary">Login</button>
  </form> -->
</div>
