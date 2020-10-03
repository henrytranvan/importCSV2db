<?php

namespace ImportUser\Csv\Connection;

/**
 * Interface for a database.
 */
interface DatabaseInterface
{
  public function getConnection();
}
