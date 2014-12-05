<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'NetworkPortVlan',
    'menu'          => ''
);
$table['fields'] = array(
    'id'              => DBModels::type('increments',
                                        array('visible' => false)),
    'network_port_id' => DBModels::type('integer'),
    'vlan_id'         => DBModels::type('integer'),
    'tagged'          => DBModels::type('boolean'),

);


$table['relationships'] = array(
    'vlan'     => array(
        'type'  => 'belongsTo',
        'item'  => 'Vlan'),
    'network_port' => array(
        'type'  => 'belongsTo',
        'item'  => 'NetworkPort'),
);

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";