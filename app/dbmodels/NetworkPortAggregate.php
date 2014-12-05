<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'NetworkPortAggregate',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                     => DBModels::type('increments',
                                               array('visible' => false)),
    'network_port_id'        => DBModels::type('integer'),
    'network_port_list'      => DBModels::type('text'), /// COMMENT 'array of associated networkports_id',
);


$table['relationships'] = array(
    'network_port' => array(
        'type'  => 'belongsTo',
        'item'  => 'NetworkPort'),
);
