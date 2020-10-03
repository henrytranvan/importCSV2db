<?php

namespace ImportUser\Csv\Connection;

use Exception;
use PDO;

/**
 * Mysql database class.
 */
class Database implements DatabaseInterface
{
  /**
   * @var $_connection PDO;
   */
  private $_connection;

  /**
   * @var string
   *
   * Store connection error message.
   */
  private $_error;

  /**
   * Database constructor.
   *
   * @param string $host
   * @param string $db
   * @param string $user
   * @param string $pass
   */
  public function __construct($host = 'localhost', $db = '', $user = 'root', $pass = '')
  {
    try {
      $connection = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->_connection = $connection;
    } catch (Exception $e) {
      $this->_error =  "Connection failed" . $e->getMessage();
    }
  }

  /**
   * Get an connection of the Database
   *
   * @return PDO;
   */
  public function getConnection()
  {
    return $this->_connection;
  }

  public function getErrorMessage () {
    return $this->_error;
  }

}
