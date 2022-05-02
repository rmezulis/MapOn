<?php

session_start();

require_once __DIR__ . '/autoload.php';

use App\Controllers\LoginController;

\App\System\Database::getInstance()
    ->runMigrations();

LoginController::loginPage();