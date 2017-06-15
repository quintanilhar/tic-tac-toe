<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

// Require autoload
require __DIR__ . '/../vendor/autoload.php';

// Require app settings
$settings = require __DIR__ . '/../resources/settings.php';

// Creates a container
$container = new \Slim\Container($settings);

// Instantiate the app
$app = new \Slim\App($container);

// Set up dependencies
require __DIR__ . '/../resources/container.php';

// Register routes
require __DIR__ . '/../resources/routes.php';

// Run app
$app->run();
