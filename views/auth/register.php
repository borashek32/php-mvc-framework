<?php
/**
 * @var $model \app\models\User
 */
$this->title = 'Registration';
?>

<div class="col-md-4 offset-md-4">
  <h1 class="text-center mt-5">Create an account</h1>

  <?php $form = \app\core\form\Form::begin('', "post") ?>
    <?php echo $form->field($model, 'firstname') ?>
    <?php echo $form->field($model, 'lastname') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>

    <button type="submit" class="btn btn-outline-primary">Register</button>
  <?php \app\core\form\Form::end() ?>
</div>
