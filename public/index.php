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
$app->post('/computers', function () use($app) {
   $app->response()->header("Content-Type", "application/json");
   $request = $app->request();
   $body = $request->getBody();
   $input = json_decode($body, true);
   $computer = new Computer();
   foreach($input as $key=>$value) {
      $computer->$key = $value;
   }
   $computer->save();
   echo json_encode(array("id" => $computer->id));

});

// PUT
$app->put('/computers/:id', function ($id) use ($app) {
   $app->response()->header("Content-Type", "application/json");
   $request = $app->request();
   $body = $request->getBody();
   $input = json_decode($body, true);
   $computer = Computer::find($id);
   foreach($input as $key=>$value) {
      $computer->$key = $value;
   }
   $computer->save();
});

// DELETE
$app->delete('/computers/:id', function ($id) {
   Computer::destroy($id);
});

$app->run();

