<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'NetworkPortEthernet',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                     => DBModels::type('increments',
                                               array('visible' => false)),
    'network_port_id'        => DBModels::type('integer'),
    'device_network_card_id' => DBModels::type('integer'),
    'netpoint_id'            => DBModels::type('integer'), 
    'type'                   => DBModels::type('string'), /// COMMENT 'T, LX, SX',
    'speed'                  => DBModels::type('integer',array('default'=>10)), /// COMMENT 'Mbit/s: 10, 100, 1000, 10000',

);


$table['relationships'] = array(
    'network_port' => array(
        'type'  => 'belongsTo',
        'item'  => 'NetworkPort'),
    'device_network_card' => array(
        'type'  => 'belongsTo',
        'item'  => 'DeviceNetworkCard'),
    'netpoint' => array(
        'type'  => 'belongsTo',
        'item'  => 'Netpoint'),
);
