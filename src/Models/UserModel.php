<?php

namespace ImportUser\Csv\Models;

use Exception;
use PDO;
use PDOException;

/**
 * User model class
 */
class UserModel extends Model {
  /**
   * @var string
   *
   * Store table name.
   */
  protected static $tableName = 'users';

  /**
   * Create table in database.
   */
  public function createUserTable() {
    $messages = [];
    $tblName = self::$tableName;
    // Drop table if exist.
    $drop = "DROP TABLE IF EXISTS $tblName";
    try {
      $this->_db->getConnection()->exec($drop);
      $messages['status'][] = "Old table $tblName has been dropped.";
    } catch(PDOException $e) {
      $messages['error'][] =  $drop . ': ' .  $e->getMessage();
    }
    // Create table.
    $sql = "CREATE TABLE $tblName (
            id SERIAL,
            name NVARCHAR(30),
            surname NVARCHAR(30),
            email NVARCHAR(50) NOT NULL,
            PRIMARY KEY (id))";
    try {
      $this->_db->getConnection()->exec($sql);
      $messages['status'][] = "Table $tblName has been created successfully.";
    } catch(PDOException $e) {
      $messages['error'][] = $sql . ': ' . $e->getMessage();
    }
    // Create unique index constraint.
    $constraint = "CREATE UNIQUE INDEX email ON $tblName(email)";
    try {
      $this->_db->getConnection()->exec($constraint);
      $messages['status'][] = "Email unique index has been created successfully on $tblName.";
    } catch(PDOException $e) {
      $messages['error'][] = $constraint . ': ' . $e->getMessage();
    }
    return $messages;
  }

  /**
   * @param $filePath
   * @param bool $dryRun
   *
   * @return array
   * Return array messages.
   */
  public function importDataFromCSV($filePath, $dryRun = FALSE) {
    $messages = [];
    $rows = 1;
    $completed = 0;
    $uncompleted = 0;
    if (file_exists($filePath)) {
        if (($fileHandler = fopen($filePath, "r")) !== FALSE) {
            $sql = "INSERT INTO `users`(`name`, `surname`, `email`) VALUES (:name, :surname, :email)";
            $statement = $this->_db->getConnection()->prepare($sql);
            while (($data = fgetcsv($fileHandler, 1000, ",")) !== FALSE) {
                // Skipp the first row.
                if($rows === 1) {
                    $rows++;
                }
                else {
                    if (!empty($data[2]) && filter_var(trim($data[2]), FILTER_VALIDATE_EMAIL)) {
                        $name = '';
                        $surname = '';
                        $email = trim($data[2]);
                        if (isset($data[0])) {
                            $name = ucfirst(strtolower(trim($data[0])));
                        }
                        if (isset($data[1])) {
                            $surname = ucfirst(strtolower(trim($data[1])));
                        }
                        // Do not insert data if dry run.
                        if (!$dryRun) {
                            try {
                                $statement->bindValue(':name', $name, PDO::PARAM_STR);
                                $statement->bindValue(':surname', $surname, PDO::PARAM_STR);
                                $statement->bindValue(':email', $email, PDO::PARAM_STR);
                                $inserted = $statement->execute();
                                // print a status message
                                if($inserted){
                                    $completed++;
                                    echo sprintf("Row %d has created successfully!\n", $rows);
                                }
                                else {
                                    $uncompleted++;
                                    $messages['error'][] =  sprintf("Error can not insert row %d", $rows);
                                }
                            }
                            catch (PDOException $e) {
                                $uncompleted++;
                                $messages['error'][] = sprintf("%s", $e->getMessage());
                            }
                        }
                    }
                    else {
                        $uncompleted++;
                        $messages['error'][] =  sprintf('Row %d has invalid value', $rows);
                    }
                    $rows++;
                }
            }
            // Log a message.
            if ($rows > 1) {
                $messages['status'][] = sprintf("%d rows created!", $completed);
                $messages['error'][] = sprintf("%d rows fails!", $uncompleted);
            }
            // Close file handler.
            fclose($fileHandler);
        }
    }
    else {
        $messages['error'][] = sprintf("File %s doesn't exist!!", $filePath);
    }
    return $messages;
  }
}
