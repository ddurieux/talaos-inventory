<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'NetworkPort',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                 => DBModels::type('increments',
                                           array('visible' => false)),
    'name'               => DBModels::type('string'),
    'comment'            => DBModels::type('text'),
    'is_deleted'         => DBModels::type('boolean',
                                           array('visible' => false)),
    'is_dynamic'         => DBModels::type('boolean',
                                           array('visible' => false)),
    'asset_id'           => DBModels::type('integer'),
    'logical_number'     => DBModels::type('integer'),
    'instantiation_type' => DBModels::type('string'),
    'mac'                => DBModels::type('string'),

);

$table['relationships'] = array(
    'asset'     => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'vlans'     => array(
        'type'  => 'belongsToMany',
        'item'  => 'Vlan',
        'linktable' => 'network_port_vlans',
        'linkfields' => array('tagged')),
);

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";