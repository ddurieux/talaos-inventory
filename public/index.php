<?php

// Autoload our dependencies with Composer
require '../vendor/autoload.php';
require '../app/dbmodels.php';


$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});



/**
 * Get all items you can see / fields you can see
 *
 * @apirest
 * @HTTPmethod GET
 *
 * @uses /item will get all items you can see
 * @uses /item/itemname will get all fields of item 'Itemname' use can see
 */
$app->get('/item(/:param?)', function ($param='') {
    $a = array();
    if (empty($param)) {
        $a = array(
            'Asset',
            'Manufacturer',
            'AssetType');
    } else {
        $item = new $param;
        $a = $item->getFields();
    }
    echo json_encode($a);
});



/**
 * Get all rows of item
 *
 * @apirest
 * @HTTPmethod GET
 *
 * @uses /Itemname will get all rows of item 'Itemname'
 * @uses /Itemname/relat will get all rows of item 'Itemname' + relationship 'relat'
 */
$app->get('/:item(/:param+)', function ($item, $param=array()) {
   $a = $item::with($param)->get();
   echo $a->toJson(JSON_PRETTY_PRINT);
})->conditions(array('param' => '[a-z]+'));


/**
 * Get one row of item
 *
 * @apirest
 * @HTTPmethod GET
 *
 * @uses /Itemname/idnum will get the row of item 'Itemname' have id=idnum (idnum is integer)
 * @uses /Itemname/idnum/relat will get the row of item 'Itemname' + relationship 'relat' have id=idnum (idnum is integer)
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
 * Add a new row of item
 *
 * @apirest
 * @HTTPmethod POST
 *
 * @uses /Itemname will add new row of item 'Itemname' with array in $_POST variable
 */
$app->post('/:itemtype', function ($itemtype) use($app) {
   $app->response()->header("Content-Type", "application/json");
   $request = $app->request();
   $body = $request->getBody();
   $input = json_decode($body, true);
   $item = new $itemtype();
   foreach($input as $key=>$value) {
      $item->$key = $value;
   }
   $item->save();
   echo json_encode(array("id" => $item->id));

});


/**
 * update a row of item
 *
 * @apirest
 * @HTTPmethod PUT
 *
 * @uses /Itemname/idnum will update the row of item 'Itemname' with id=idnum (idnum is integer)
 */
$app->put('/:itemtype/:id', function ($itemtype, $id) use ($app) {
   $app->response()->header("Content-Type", "application/json");
   $request = $app->request();
   $body = $request->getBody();
   $input = json_decode($body, true);
   $item = $itemtype::find($id);
   foreach($input as $key=>$value) {
      $item->$key = $value;
   }
   $item->save();
})->conditions(array('id' => '\d+'));

/**
 * delete a row of item
 *
 * @apirest
 * @HTTPmethod DELETE
 *
 * @uses /Itemname/idnum will delete the row of item 'Itemname' with id=idnum (idnum is integer)
 */
$app->delete('/:item/:id', function ($item, $id) {
   $item::destroy($id);
})->conditions(array('id' => '\d+'));


$app->run();
//if (isset($sqllog)) {
//   echo $sqllog;
//}
//echo "Memory : ".(memory_get_usage() / 1000000)." Mo";