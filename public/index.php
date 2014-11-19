<?php

// Autoload our dependencies with Composer
require '../vendor/autoload.php';
require '../app/dbmodels.php';


$app = new \Slim\Slim();

//Enable debugging (on by default)
$app->config('debug', true);

//Enable logging
$app->log->setEnabled(true);

//Define error log file
$app->log->setWriter(new Customlog($app->log));

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
 * @uses /item/itemname/restrict restrictget fields 'visible' (default) or 'all'
 */
$app->get('/item(/:param?)(/:restrict?)', function ($param='', $restrict='visible') {
    $a = array();
    if (empty($param)) {
        $tables = DBModels::getDBModels();
        $a = array();
        foreach ($tables as $table) {
            if (!empty($table['menu'])) {
                if (!(strpos($table['model'], "Asset") === 0)
                     || $table['model'] == 'AssetType') {
                    $a[] = array(
                        'item' => $table['model'],
                        'name' => $table['model'],
                        'menu' => $table['menu']
                    );
                }
            }
        }
        $assettypes = AssetType::get();
        foreach ($assettypes as $data) {
            $a[] = array(
                'item' => 'Asset__'.$data['id'],
                'name' => $data['name'],
                'menu' => 'Asset'
            );
        }
    echo json_encode($a);
    } else {
        $item = new $param;
        $a = $item->getFields($restrict);
        echo json_encode($a, JSON_PRETTY_PRINT);
    }
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
$app->get('/:item(/:param+)', function ($item, $param=array()) use ($app) {
    $page = 1;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    $per_page = 10;
    if (isset($_GET['per_page'])) {
        $per_page = $_GET['per_page'];
    }
    $offset = ($page * $per_page) - $per_page;
   if (strstr($item, '__')) {
       $split = explode('__', $item);
       $assettype_id = $split[1];
       $itemname = $split[0];
       $a = $itemname::take($per_page)->offset($offset)->with($param)->where('assettype_id', '=', $assettype_id)->get();
       $total = $itemname::with($param)->where('assettype_id', '=', $assettype_id)->count();
   } else {
       $a = $item::take($per_page)->offset($offset)->with($param)->get();
       $total = $item::with($param)->count();
   }
   $meta = array();
   // Define total in header
   $meta['total'] = $total;

   $meta['perpage'] = $per_page;

   $totalpage = ceil($total / $per_page);
   if ($totalpage == 0) {
       $totalpage = 1;
   }
   $meta['totalpage'] = $totalpage;

   $meta['currentpage'] = $page;

   // Define links
   $links = array();
   $linkBaseURL = $app->request->getUrl()
    . $app->request->getRootUri()
    . $app->request->getResourceUri()
    . "?";
   $query_string = $_GET;
   $query_string['page'] = $page++;
   $query_string['per_page'] = $per_page;
   $output = implode('&', array_map(function ($v, $k) { return $k . '=' . $v; }, $query_string, array_keys($query_string)));
   $next = $linkBaseURL.$output;
   $links[] = sprintf('<%s>; rel="next"', $next);

   $query_string['page'] = ceil($total / $per_page);
   $output = implode('&', array_map(function ($v, $k) { return $k . '=' . $v; }, $query_string, array_keys($query_string)));
   $last = $linkBaseURL.$output;
   $links[] = sprintf('<%s>; rel="last"', $last);

   $query_string['page'] = 0;
   $output = implode('&', array_map(function ($v, $k) { return $k . '=' . $v; }, $query_string, array_keys($query_string)));
   $first = $linkBaseURL.$output;
   $links[] = sprintf('<%s>; rel="first"', $first);

   $query_string['page'] = $page--;
   $output = implode('&', array_map(function ($v, $k) { return $k . '=' . $v; }, $query_string, array_keys($query_string)));
   $prev = $linkBaseURL.$output;
   $links[] = sprintf('<%s>; rel="prev"', $prev);
   $meta['Link'] = $links;

   $app->response->headers->set('Link', implode(', ', $links));
   // Display json with data
   echo json_encode(array('data' => $a, 'meta' => $meta), JSON_PRETTY_PRINT);
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
   if (strstr($item, '__')) {
       $split = explode('__', $item);
       $item = $split[0];
   }

   if (isset($_GET)
       && !empty($_GET)) {

       $key = key($_GET);
       $a = $item::where($key, '=', $_GET[$key])->first();
       if ($a) {
           $i = new $item;
           $meta = $i->getFields();
           echo json_encode(array('data' => $a, 'meta' => $meta['meta']), JSON_PRETTY_PRINT);
           return;
       } else {
           echo json_encode(array());
           return;
       }
   }

   if ($item == 'Asset') {
       $a = $item::with('assetschild')->find($id);
   } else {
       $a = $item::find($id);
   }
   $a->load($param);
   $i = new $item;
   $meta = $i->getFields();
   $extendedModels = $item::getRelatedModels($id);
   echo json_encode(array(
       'data'          => $a,
       'relatedmodels' => $extendedModels,
       'meta'          => $meta['meta']), JSON_PRETTY_PRINT);
})->conditions(array('id' => '\d+'));



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
   if (strstr($itemtype, '__')) {
       $split = explode('__', $itemtype);
       $input['assettype_id'] = $split[1];
       $itemtype = $split[0];
   }
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
   if (strstr($itemtype, '__')) {
       $split = explode('__', $itemtype);
       $input['assettype_id'] = $split[1];
       $itemtype = $split[0];
   }
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
    if (strstr($item, '__')) {
       $split = explode('__', $item);
       $item = $split[0];
    }

    $item::destroy($id);
})->conditions(array('id' => '\d+'));


$app->run();
// if (isset($sqllog)) {
//   echo $sqllog;
// }
//echo "Memory : ".(memory_get_usage() / 1000000)." Mo";