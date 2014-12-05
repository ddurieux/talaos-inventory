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
    'networkport_id'     => DBModels::type('integer'),
    'logical_number'     => DBModels::type('integer'),
    'instantiation_type' => DBModels::type('string'),
    'mac'                => DBModels::type('string'),

);

$table['relationships'] = array(
    'asset'     => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'network_port' => array(
        'type'  => 'belongsTo',
        'item'  => 'NetworkPort'),
    'network_names' => array(
        'type' => 'morphMany',
        'item' => 'NetworkName'),        
    'vlans'     => array(
        'type'  => 'belongsToMany',
        'item'  => 'Vlan',
        'linktable' => 'network_port_vlans',
        'linkfields' => array('tagged')),
    'network_port_wifi'   => array(
        'type'  => 'hasOne',
        'item'  => 'NetworkPortWifi'),        
    'network_port_local'   => array(
        'type'  => 'hasOne',
        'item'  => 'NetworkPortLocal'),        
    'network_port_ethernet'   => array(
        'type'  => 'hasOne',
        'item'  => 'NetworkPortEthernet'),        
    'network_port_dialup'   => array(
        'type'  => 'hasOne',
        'item'  => 'NetworkPortDialup'),        
    'network_port_aggregate'   => array(
        'type'  => 'hasOne',
        'item'  => 'NetworkPortDialup'),             
    'network_port_alias'   => array(
        'type'      => 'belongsToMany',
        'item'      => 'NetworkPort',
        'linktable' => 'network_port_aliases',
        'field2'    => 'network_port_alias_id'),        
);

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";