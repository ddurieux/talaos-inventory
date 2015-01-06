<?php

use \Slim\Slim as Slim;

// set timezone for timestamps etc
date_default_timezone_set('UTC');

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

