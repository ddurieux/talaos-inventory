<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'NetworkPortAlias',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                     => DBModels::type('increments',
                                               array('visible' => false)),
    'network_port_id'        => DBModels::type('integer'),
    'network_port_alias_id'  => DBModels::type('integer'),
);


$table['relationships'] = array(
    'network_port' => array(
        'type'  => 'belongsTo',
        'item'  => 'NetworkPort'),
    'network_port_alias' => array(
        'type'  => 'belongsTo',
        'item'  => 'NetworkPort'),
);
