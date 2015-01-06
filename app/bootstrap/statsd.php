<?php


$configs['statsd'] = include_once $app->paths['config'] . '/statsd.cfg.php';


// Setup statsd
if ($configs['statsd']['host'] == '') {
    $connection = new Domnikl\Statsd\Connection\Blackhole();
    $statsd = new \Domnikl\Statsd\Client($connection, "test.namespace");
} else {
    $connection = new \Domnikl\Statsd\Connection\UdpSocket(
        $configs['statsd']['host'],
        $configs['statsd']['port']
    );
    $statsd = new \Domnikl\Statsd\Client($connection, "test.namespace");
}
$statsd->setNamespace($configs['statsd']['namespace']);

function log_stats_on_shutdown() {
   global $statsd, $timer;
   $statsd->increment("page");
   $statsd->timing("time", (microtime(true) - $timer) * 1000);
   $statsd->gauge('memory', memory_get_peak_usage());
}

register_shutdown_function('log_stats_on_shutdown');
