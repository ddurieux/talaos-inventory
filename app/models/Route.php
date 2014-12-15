<?php

class Route {


    function routes($app) {


        /**
         * Get all resources available / fields available
         *
         * @apirest
         * @HTTPmethod GET
         *
         * @uses /item will get all items you can see
         * @uses /item/itemname will get all fields of item 'Itemname' use can see
         * @uses /item/itemname/restrict restrictget fields 'visible' (default) or 'all'
         */
        $app->get('/v1/item(/:param?)(/:restrict?)', function ($param='', $restrict='visible') use ($app) {
            $this->getResources($param, $restrict, $app);
        });


        /**
         * Get a resource
         *
         * @apirest
         * @HTTPmethod GET
         *
         * @uses /Itemname/idnum will get the row of item 'Itemname' have id=idnum (idnum is integer)
         * @uses /Itemname/idnum/relat will get the row of item 'Itemname' + relationship 'relat' have id=idnum (idnum is integer)
         */
        $app->get('/v1/:item/:id(/:param+)', function ($item, $id, $param = array()) use ($app) {
            $this->getOneResource($app, $item, $id, $param);
        })->conditions(array('id' => '\d+'));

        /**
         * Get list of resources
         *
         * @apirest
         * @HTTPmethod GET
         *
         * @uses /Itemname will get all rows of item 'Itemname'
         * @uses /Itemname/relat will get all rows of item 'Itemname' + relationship 'relat'
         */
        $app->get('/v1/:item(/:param+)', function ($item, $param=array()) use ($app) {
            $this->getAllResources($item, $param, $app);
        });






        /**
         * Add a new resource
         *
         * @apirest
         * @HTTPmethod POST
         *
         * @uses /Itemname will add new row of item 'Itemname' with array in $_POST variable
         */
        $app->post('/v1/:itemtype', function ($itemtype) use($app) {
            $this->addResource($itemtype, $app);
        });



        /**
         * update a resource
         *
         * @apirest
         * @HTTPmethod PUT
         *
         * @uses /Itemname/idnum will update the row of item 'Itemname' with id=idnum (idnum is integer)
         */
        $app->put('/v1/:itemtype/:id', function ($itemtype, $id) use ($app) {
            $this->updateResource($itemtype, $id, $app);
        })->conditions(array('id' => '\d+'));



        /**
         * delete a resource
         *
         * @apirest
         * @HTTPmethod DELETE
         *
         * @uses /Itemname/idnum will delete the row of item 'Itemname' with id=idnum (idnum is integer)
         */
        $app->delete('/v1/:item/:id', function ($item, $id) use($app) {
            $this->deleteResource($app, $item, $id);
        })->conditions(array('id' => '\d+'));

    }



    function getResources($param, $restrict, $app) {
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
            if (strstr($param, '__')) {
               $split = explode('__', $param);
               $param = $split[0];
            }

            if (!class_exists($param)) {
                $app->log->error("LOADCLASS[50001]: The class ".$param." not exist");
            }
            $item = new $param;
            $a = $item->getFields($restrict);
            echo json_encode($a, JSON_PRETTY_PRINT);
        }
    }



    function getAllResources($item, $param, $app) {
        $offset = 0;
        $limit = 10;
        $fields = array();
        if (isset($_GET['offset'])) {
            $offset = intval($_GET['offset']);
        }
        if (isset($_GET['limit'])) {
            $limit = intval($_GET['limit']);
        }
        if (isset($_GET['fields'])) {
            $fields = explode(',', $_GET['fields']);
        }
        if (empty($fields)) {
            $fields = array('*');
        }

        if (strstr($item, '__')) {
            $split = explode('__', $item);
            $assettype_id = $split[1];
            $itemname = $split[0];
            if (!class_exists($itemname)) {
                $app->log->error("LOADCLASS[50002]: The class ".$itemname." not exist");
            }
            $i = new $itemname;
            $query = $i->take($limit)->offset($offset)->with($param);
            $query->where('asset_type_id', '=', $assettype_id);
            $i_fields = $i->getFields();
            $tot = $itemname::where('asset_type_id', '=', $assettype_id);
            if (isset($i_fields['data']['entity_id'])) {
                $entity = Entity::find(1); // get first entity
                $query->restrictentity($entity);
                $tot->restrictentity($entity);
            }
            $total = $tot->count();
        } else {
            if (!class_exists($item)) {
                $app->log->error("LOADCLASS[50003]: The class ".$item." not exist");
            }
            $i = new $item;
            $query = $i->take($limit)->offset($offset)->with($param);
            $i_fields = $i->getFields();
            $tot = $i;
            if (isset($i_fields['data']['entity_id'])) {
                $entity = Entity::find(1); // get first entity
                $query->restrictentity($entity);
                $tot->restrictentity($entity);
            }
            $total = $tot->count();
        }
        if (isset($_GET['sort'])) {
            $sorts = explode(',', $_GET['sort']);
            foreach ($sorts as $sort) {
                $field = substr($sort, 1);
                if (substr($sort, 0, 1) == '+') {
                    $query->orderBy($field);
                } else if (substr($sort, 0, 1) == '-') {
                    $query->orderBy($field, 'desc');
                }
            }
        }
        $a = $query->get($fields);

        $meta = array();
        // Define total in header
        $meta['total']  = $total;
        $meta['limit']  = $limit;
        $meta['offset'] = $offset;

        // Define links
        $links = array();
    //   $linkBaseURL = $app->request->getUrl()
    //    . $app->request->getRootUri()
    //    . $app->request->getResourceUri()
    //    . "?";
    //   $query_string = $_GET;
    //   $query_string['page'] = $page++;
    //   $query_string['per_page'] = $per_page;
    //   $output = implode('&', array_map(function ($v, $k) { return $k . '=' . $v; }, $query_string, array_keys($query_string)));
    //   $next = $linkBaseURL.$output;
    //   $links[] = sprintf('<%s>; rel="next"', $next);
    //
    //   $query_string['page'] = ceil($total / $per_page);
    //   $output = implode('&', array_map(function ($v, $k) { return $k . '=' . $v; }, $query_string, array_keys($query_string)));
    //   $last = $linkBaseURL.$output;
    //   $links[] = sprintf('<%s>; rel="last"', $last);
    //
    //   $query_string['page'] = 0;
    //   $output = implode('&', array_map(function ($v, $k) { return $k . '=' . $v; }, $query_string, array_keys($query_string)));
    //   $first = $linkBaseURL.$output;
    //   $links[] = sprintf('<%s>; rel="first"', $first);
    //
    //   $query_string['page'] = $page--;
    //   $output = implode('&', array_map(function ($v, $k) { return $k . '=' . $v; }, $query_string, array_keys($query_string)));
    //   $prev = $linkBaseURL.$output;
    //   $links[] = sprintf('<%s>; rel="prev"', $prev);
    //   $meta['Link'] = $links;

        $app->response->headers->set('Link', implode(', ', $links));
        // Display json with data
        echo json_encode(array('data' => $a, 'meta' => $meta), JSON_PRETTY_PRINT);
    }



    function getOneResource($app, $item, $id, $param) {

        if (strstr($item, '__')) {
           $split = explode('__', $item);
           $item = $split[0];
        }
        if (!class_exists($item)) {
            $app->log->error("LOADCLASS[50004]: The class ".$item." not exist");
        }

        // Special for Asset
        if (isset($_GET)
                && isset($_GET['asset_id'])) {

            $a = $item::where('asset_id', '=', $_GET['asset_id'])->first();
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
        if (empty($a)) {
            $app->log->notice("GETITEM[50005]: This item ".$id." is not found in DB");
        }
        $a->load($param);
        $i = new $item;
        $meta = $i->getFields();
        $extendedModels = $item::getRelatedModels($id);

        if (isset($_GET)) {
            if (isset($_GET['ancestor'])) {
                $extendedModels['ancestor'] = $a->getAncestors()->toHierarchy();
            }
            if (isset($_GET['descendant'])) {
                $extendedModels['descendant'] = $a->getDescendants()->toHierarchy();
            }
        }
        echo json_encode(array(
            'data'          => $a,
            'relatedmodels' => $extendedModels,
            'meta'          => $meta['meta']), JSON_PRETTY_PRINT);
    }



    function addResource($itemtype, $app) {
        $app->response()->header("Content-Type", "application/json");
        $request = $app->request();
        $body = $request->getBody();
        $input = json_decode($body, true);
        if (strstr($itemtype, '__')) {
            $split = explode('__', $itemtype);
            $input['assettype_id'] = $split[1];
            $itemtype = $split[0];
        }
        if (!class_exists($itemtype)) {
            $app->log->error("LOADCLASS[50006]: The class ".$itemtype." not exist");
        }

        $item = new $itemtype();
        foreach($input as $key=>$value) {
            $item->$key = $value;
        }
        $item->save();
        echo json_encode(array("id" => $item->id));
    }



    function updateResource($itemtype, $id, $app) {
        $app->response()->header("Content-Type", "application/json");
        $request = $app->request();
        $body = $request->getBody();
        $input = json_decode($body, true);
        if (strstr($itemtype, '__')) {
            $split = explode('__', $itemtype);
            $input['assettype_id'] = $split[1];
            $itemtype = $split[0];
        }
        if (!class_exists($itemtype)) {
            $app->log->error("LOADCLASS[50007]: The class ".$itemtype." not exist");
        }
        $item = $itemtype::find($id);
        foreach($input as $key=>$value) {
            $item->$key = $value;
        }
        $item->save();
    }



    function deleteResource($app, $item, $id) {
        if (strstr($item, '__')) {
            $split = explode('__', $item);
            $item = $split[0];
        }
        if (!class_exists($item)) {
            $app->log->error("LOADCLASS[50008]: The class ".$item." not exist");
        }
        $item::destroy($id);
    }
}