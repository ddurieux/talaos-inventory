<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'NetworkPortWifi',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                     => DBModels::type('increments',
                                               array('visible' => false)),
    'network_port_id'        => DBModels::type('integer'),
    'device_network_card_id' => DBModels::type('integer'),
    'wifi_network_id'        => DBModels::type('integer'),
    'network_port_wifi_id'   => DBModels::type('integer'), /// COMMENT 'only usefull in case of Managed node'
    'version'                => DBModels::type('string'), /// COMMENT 'a, a/b, a/b/g, a/b/g/n, a/b/g/n/y',
    'mode'                   => DBModels::type('string'), /// COMMENT 'ad-hoc, managed, master, repeater, secondary, monitor, auto',

);


$table['relationships'] = array(
    'network_port' => array(
        'type'  => 'belongsTo',
        'item'  => 'NetworkPort'),
    'device_network_card' => array(
        'type'  => 'belongsTo',
        'item'  => 'DeviceNetworkCard'),
    'network_port_wifi_id' => array(
        'type'  => 'belongsTo',
        'item'  => 'NetworkPortWifi'),
);
