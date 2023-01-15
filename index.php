<?php

require __DIR__.'/includes/app.php';

use \App\Http\Router;

// Initialize Router
$obRouter = new Router(URL);

// Include the pages routes
include __DIR__.'/routes/pages.php';

// Print the route response
$obRouter->run()->sendResponse();
