<?php

use \Slim\Slim as Slim;
use Slim\Environment as Environment;

// set timezone for timestamps etc
date_default_timezone_set('UTC');

// Check whether we are running in cli mode in order to mock the SLIM environment
if (php_sapi_name() === 'cli') {
   Environment::mock();
}

$app = new Slim();

//Enable debugging (on by default)
$app->config('debug', true);

//Enable logging
$app->log->setEnabled(true);

//Define error log file
$app->log->setWriter(new Customlog($app->log));

$app->paths = [
   'config' => CONFIG_PATH,
];

// Setup application routes
$route = new Route();
$route->routes($app);

