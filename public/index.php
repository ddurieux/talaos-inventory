<?php

// Autoload our dependencies with Composer
require '../vendor/autoload.php';
require '../app/dbmodels.php';


$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});


$app->get('/:item', function ($item) {
   $a = $item::all();
   echo $a->toJson(JSON_PRETTY_PRINT);
});


/**
 * GET
 */
$app->get('/:item/:id(/:param+)', function ($item, $id, $param = array()) {
   $a = $item::find($id);
   $a->load($param);
   echo $a->toJson(JSON_PRETTY_PRINT);
});

/*
$app->get('/computers/:id', function ($id) {
   $computer = Computer::with('operatingsystems','monitors')->where('id', '=', $id)->get();
   //$computer = Computer::where('id', '=', $id)->get();
   echo $computer->toJson(JSON_PRETTY_PRINT);
});

$app->get('/operatingsystems/:id', function ($id) {
   $os = OperatingSystem::where('id', '=', $id)->get();
   echo $os->toJson(JSON_PRETTY_PRINT);
});
*/


/**
 * POST
 */
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

/**
 * PUT
 */
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

/**
 * DELETE
 */
$app->delete('/computers/:id', function ($id) {
   Computer::destroy($id);
});


$app->run();
if (isset($sqllog)) {
   echo $sqllog;
}
echo "Memory : ".(memory_get_usage() / 1000000)." Mo";