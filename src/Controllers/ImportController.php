<?php

namespace ImportUser\Csv\Controllers;

use ImportUser\Csv\Models\UserModel;

/**
 * Class ImportController
 * @package ImportUser\Csv\Controllers
 */
class ImportController {
  /**
   * @var UserModel;
   */
  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  /**
   * Create database table.
   * @return array
   * Status and error message.
   */
  public function createTable() {
    return $this->model->createUserTable();
  }

  /**
   * Import data from file.
   * @param $filePath
   * @param $dryRun
   *
   * @return array
   *
   */
  public function importData($filePath, $dryRun) {
    return $this->model->importDataFromCSV($filePath, $dryRun);
  }
}
