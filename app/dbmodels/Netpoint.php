<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Netpoint',
    'menu'          => ''
);
$table['fields'] = array(
    'id'           => DBModels::type('increments',
                                     array('visible' => false)),
    'location_id'  => DBModels::type('integer'),
    'name'         => DBModels::type('string'),
    'comment'      => DBModels::type('text'),
);


$table['relationships'] = array(
    'location' => array(
        'type' => 'belongsTo',
        'item' => 'Location'),
);
include "_commonentitylink.php";
