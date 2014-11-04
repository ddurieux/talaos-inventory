<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

/**
 * Configure the database and boot Eloquent
 */
$capsule = new Capsule;

$capsule->addConnection(array(
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'glping',
    'username'  => 'glping',
    'password'  => 'glping',
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => ''
));

$capsule->setEventDispatcher(new Dispatcher(new Container));

$capsule->setAsGlobal();

$capsule->bootEloquent();

// Stand alone
$sqllog = '';
$capsule->getEventDispatcher()->listen('illuminate.query', function($sql) use (&$sqllog) {
   global $sqllog;
   $sqllog .= '<pre>'. $sql .'</pre>';
});


// set timezone for timestamps etc
date_default_timezone_set('UTC');
