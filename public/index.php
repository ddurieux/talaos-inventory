<?php

// Autoload our dependencies with Composer
require '../vendor/autoload.php';
require '../app/dbmodels.php';


$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});


$app->get('/:item(/:param+)', function ($item, $param=array()) {
   $a = $item::with($param)->get();
   echo $a->toJson(JSON_PRETTY_PRINT);
})->conditions(array('param' => '[a-zA-Z]+'));


/**
 * GET
 */
$app->get('/:item/:id(/:param+)', function ($item, $id, $param = array()) {
   $a = $item::find($id);
   $a->load($param);
   echo $a->toJson(JSON_PRETTY_PRINT);
})->conditions(array('id' => '\d+'));

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
$app->post('/Asset', function () use($app) {
   $app->response()->header("Content-Type", "application/json");
   $request = $app->request();
   $body = $request->getBody();
   $input = json_decode($body, true);
   $asset = new Asset();
   foreach($input as $key=>$value) {
      $asset->$key = $value;
   }
   $asset->save();
   echo json_encode(array("id" => $asset->id));

});

/**
 * PUT
 */
$app->put('/Asset/:id', function ($id) use ($app) {
   $app->response()->header("Content-Type", "application/json");
   $request = $app->request();
   $body = $request->getBody();
   $input = json_decode($body, true);
   $asset = Asset::find($id);
   foreach($input as $key=>$value) {
      $asset->$key = $value;
   }
   $asset->save();
});

/**
 * DELETE
 */
$app->delete('/Asset/:id', function ($id) {
   Asset::destroy($id);
});


$app->run();
//if (isset($sqllog)) {
//   echo $sqllog;
//}
//echo "Memory : ".(memory_get_usage() / 1000000)." Mo";