<?php

$timer = microtime(true);

// Autoload our dependencies with Composer
require '../vendor/autoload.php';
require '../app/dbmodels.php';


$app = new \Slim\Slim();

//Enable debugging (on by default)
$app->config('debug', true);

//Enable logging
$app->log->setEnabled(true);

//Define error log file
$app->log->setWriter(new Customlog($app->log));

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$route = new Route();
$route->routes($app);

$app->run();

// if (isset($sqllog)) {
//   echo $sqllog;
// }
//echo "Memory : ".(memory_get_usage() / 1000000)." Mo";
$statsd->increment("page");
$statsd->timing("time", (microtime(true) - $timer) * 1000);
$statsd->gauge('memory', memory_get_peak_usage());
