<?php

namespace ImportUser\Csv\Models;

use ImportUser\Csv\Connection\Database;

/**
 * Model base class
 */
abstract class Model {

  /**
   * @var Database
   *
   * Store database instance.
   */
  protected $_db;

  /**
   * @var string
   *
   * Store table name.
   */
  protected static $tableName = '';

  /**
   * Model constructor.
   * @param Database $db
   */
  public function __construct(Database $db) {
    $this->_db = $db;
  }
}
