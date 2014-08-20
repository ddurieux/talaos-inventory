<?php

// Autoload our dependencies with Composer
require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->get('/computers', function () {
   $computers = Computer::all();
   echo $computers->toJson();
});

// GET
$app->get('/computers/:id', function ($id) {
   $computer = Computer::with('operatingsystems')->where('id', '=', $id)->get();
   //$computer = Computer::where('id', '=', $id)->get();
   echo $computer->toJson();
});

// POST
$app->post('/computers', function () {
   //Create computers
});

// PUT
$app->put('/computers/:id', function ($id) {
   //Update computer identified by $id
});

// DELETE
$app->get('/computers/:id', function ($id) {
   //Delete computer identified by $id
});

$app->run();

