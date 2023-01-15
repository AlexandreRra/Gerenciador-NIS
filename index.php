<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use App\Utils\View;

define('URL','http://localhost:8000');

// Set default value for variables
View::init([
    'URL' => URL
]);

$obRouter = new Router(URL);

// Include the pages routes
include __DIR__.'/routes/pages.php';

// Print the route response
$obRouter->run()->sendResponse();
