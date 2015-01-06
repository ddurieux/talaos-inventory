<?php

$timer = microtime(true);
$configs = [];
require_once __DIR__ . '/dbmodels.php';

// get composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// setup application's paths
require_once __DIR__ . '/bootstrap/paths.php';

// setup Slim application
require_once __DIR__ . '/bootstrap/app.php';

//setup database connection
require_once __DIR__ . '/bootstrap/database.php';

// setup Statsd connection
require_once __DIR__ . '/bootstrap/statsd.php';

