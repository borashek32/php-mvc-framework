<?php

namespace app\models;

use app\core\Model;

class ContactForm extends Model
{
  public $subject = '';
  public $body    = '';
  public $email   = '';

  public function rules(): array
  {
    return [
      'subject' => [self::RULE_REQUIRED],
      'body'    => [self::RULE_REQUIRED],
      'email'   => [self::RULE_REQUIRED]
    ];
  }

  public function labels(): array
  {
    return [
      'subject' => 'Enter topic of your message',
      'email'   => 'Enter electronic address',
      'body'    => 'Enter your message'
    ];
  }

  public function send()
  {
    return true;
  }
}