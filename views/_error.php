<?php
/**
 * @var $exception \Exception
 */
$this->title = 'Oops! Error';
?>

<h1 class="text-center mt-5">
  <?php echo $exception->getCode() ?> - <?php echo $exception->getMessage() ?>
</h1>