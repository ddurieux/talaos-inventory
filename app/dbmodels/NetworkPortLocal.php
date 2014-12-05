<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'NetworkPortLocal',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                     => DBModels::type('increments',
                                               array('visible' => false)),
    'network_port_id'        => DBModels::type('integer'),
);


$table['relationships'] = array(
    'network_port' => array(
        'type'  => 'belongsTo',
        'item'  => 'NetworkPort'),
);
