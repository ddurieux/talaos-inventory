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
    'prefix'    => 'glpi_'
));

// Info for metrics about backend (no host = disabled)
$statsd_host = '127.0.0.1';
$statsd_port = '8125';
$statsd_namespace = 'glpi.backend';


$capsule->setEventDispatcher(new Dispatcher(new Container));

$capsule->setAsGlobal();

$capsule->bootEloquent();

// Stand alone
$sqllog = '';
$capsule->getEventDispatcher()->listen('illuminate.query', function($sql, $bindings, $time) use (&$sqllog) {
   global $sqllog;
   $sqllog .= '<pre>'. $sql .'</pre>';
});


// set timezone for timestamps etc
date_default_timezone_set('UTC');

// Manage statsd
global $statsd;
if ($statsd_host == '') {
    $connection = new Domnikl\Statsd\Connection\Blackhole();
    $statsd = new \Domnikl\Statsd\Client($connection, "test.namespace");
} else {
    $connection = new \Domnikl\Statsd\Connection\Socket($statsd_host, $statsd_port);
    $statsd = new \Domnikl\Statsd\Client($connection, "test.namespace");
}
$statsd->setNamespace($statsd_namespace);
