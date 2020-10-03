<?php

use ImportUser\Csv\Connection\Database;
use ImportUser\Csv\Models\UserModel;
use ImportUser\Csv\Controllers\ImportController;
use ImportUser\Csv\Views\ImportView;
use ImportUser\Csv\Views\HelpView;

$auto_loader = require_once 'autoload.php';
$args = CommandLine::parseArgs($_SERVER['argv']);
// Create database instance.
if (isset($args['h']) && isset($args['d']) && isset($args['u']) && isset($args['p'])) {
    $database = new Database($args['h'], $args['d'], $args['u'], $args['p']);
    if ($database) {
        $user_model = new UserModel($database);
        $import_controller = new ImportController($user_model);
        $import_view = new ImportView($import_controller, $user_model);
    }
}
// Help command.
if (isset($args['help'])) {
    HelpView::help();
}
elseif (isset($args['create_table']) && $import_controller) {
    $messages = $import_controller->createTable();
    $import_view->output($messages);
} else if (isset($args['dry_run'])  && isset($args['file']) && $import_controller) {
    $messages = $import_controller->importData($args['file'], TRUE);
    $import_view->output($messages);
} else if (isset($args['file']) && $import_view) {
    $messages = $import_controller->importData($args['file'], FALSE);
    $import_view->output($messages);
}
