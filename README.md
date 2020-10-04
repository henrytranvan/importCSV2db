
## Prerequisite

- Composer >= 1.10.8
- PHP >= 7.2
- Mysql >= 5.6

## Quick start

- Run `composer install`
- Help `php user_upload.php --help`
- Create table `php user_upload.php --create_table -h=localhost -d=dbname -u=user -p=password`
- Dry run `php user_upload.php --file=users.csv --dry_run -h=localhost -d=dbname -u=user -p=password`
- Import data `php user_upload.php --file=users.csv -h=localhost -d=dbname -u=user -p=password`



## Notes

- There are 3 separated branches, master and feature-import-users-from-csv-file branch contains user upload source code, feature-foobar has foobar.php source code. 
