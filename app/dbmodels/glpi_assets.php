<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'visible'       => array()
);
$table['fields'] = array(
    'id'               => DBModels::type('increments'),
    'name'             => DBModels::type('string'),
    'assettypes_id'    => DBModels::type('integer'),
    'entities_id'      => DBModels::type('integer'),
    'is_recursive'     => DBModels::type('boolean'),
    'is_deleted'       => DBModels::type('boolean'),
    'serial'           => DBModels::type('string'),
    'inventory_number' => DBModels::type('string'),
    'manufacturers_id' => DBModels::type('integer'),
    'states_id'        => DBModels::type('integer'),
    'comment'          => DBModels::type('text'),
);
$table['relationships'] = array(
    'assettypes'    => array(
        'type'  => 'belongsTo',
        'item'  => 'AssetType'),
    'manufacturers' => array(
        'type' => 'belongsTo',
        'item' => 'Manufacturer')
);
$table['visible'] = array('name', 'entities_id', 'serial');