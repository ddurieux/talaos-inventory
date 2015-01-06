<?php

use Slim\Slim as Slim;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$app = Slim::getInstance();

$configs['db'] = require_once $app->paths['config'] . '/database.cfg.php';


/**
 * Configure the database and boot Eloquent
 */
$capsule = new Capsule;

$capsule->addConnection( $configs['db'] );

$capsule->setEventDispatcher(new Dispatcher(new Container));

$capsule->setAsGlobal();

$capsule->bootEloquent();

// Stand alone
$sqllog = '';
$capsule->getEventDispatcher()->listen('illuminate.query', function ($sql, $bindings, $time) use (&$sqllog) {
   global $sqllog;
   $sqllog .= '<pre>'. $sql .' ('.print_r($bindings, true).')</pre>';
});


