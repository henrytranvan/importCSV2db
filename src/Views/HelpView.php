<?php

namespace ImportUser\Csv\Views;

/**
 * Class HelpView
 * @package ImportUser\Csv\Views
 */
class HelpView {
  /**
   *  Print help commands.
   */
  public static function help() {
    printf("Usage:\n");
    printf("  user_upload.php [options]\n");
    printf("\nOptions:\n");
    printf("  --file [csv file name] – this is the name of the CSV to be parsed\n");
    printf("  --create_table – this will cause the MySQL users table to be built\n");
    printf("  --dry_run – this will be used with the --file directive in case we want to run the
    script but not insert into the DB. All other functions will be executed, but the
    database won't be altered.\n");
    printf("  -h – MySQL host.\n");
    printf("  -d – MySQL database name.\n");
    printf("  -u – MySQL username.\n");
    printf("  -p – MySQL password.\n");
    printf("  --help – which will output the above list of directives with details.\n");
  }
}
