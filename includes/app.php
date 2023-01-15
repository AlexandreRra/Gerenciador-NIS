<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Utils\View;
use App\Common\Environment;
use App\Model\Db\Database;

// Load environment variables
Environment::load(__DIR__ . '/../');

// DB Configuration
Database::config(getenv('DB_HOST'), getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_PORT'));

// Set URL
define('URL', getenv('URL'));

// Set default value for variables
View::init([
    'URL' => URL
]);
