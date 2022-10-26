<?php
use app\core\form\TextareaField;

$this->title = 'Contact us';
/**
 * @var $model \app\models\ContactForm
 */
?>

<h1 class="text-center mt-5">Contact us</h1>

<div class="col-md-4 offset-md-4">
  <?php $form = \app\core\form\Form::begin('', "post") ?>
    <?php echo $form->field($model, 'subject') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo new TextareaField($model, 'body') ?>

    <button type="submit" class="btn btn-outline-primary">Send</button>
  <?php \app\core\form\Form::end() ?>
</div>
