<?php

namespace ImportUser\Csv\Views;

use ImportUser\Csv\Models\UserModel;
use ImportUser\Csv\Controllers\ImportController;

/**
 * Class ImportView
 * @package ImportUser\Csv\Views
 */
class ImportView {

  /**
   * @var UserModel;
   *
   * User model instance.
   */
  private $userModel;

  /**
   * @var ImportController;
   *
   * Import controller instance.
   */
  private $importController;

  public function __construct($controller, $model) {
    $this->importController = $controller;
    $this->userModel = $model;
  }

  public function output(array $messages) {
    if ($messages['status']) {
      echo str_pad('',  80, "*");
      printf("\nStatus:\n");
      $this->printStatusMessages($messages['status']);
    }
    if ($messages['error']) {
      echo str_pad('',  80, "*");
      printf("\nError:\n");
      $this->printStatusMessages($messages['error']);
    }
  }

  /**
   * @param array $message
   */
  protected function printStatusMessages(array $messages) {
    foreach ($messages as $message) {
      printf("  $message\n");
    }
  }
}
