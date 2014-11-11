<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array()
);
$table['fields'] = array(
    'id'               => DBModels::type('increments'),
    'name'             => DBModels::type('string'),
    'assettypes_id'    => DBModels::type('integer'),
    'entities_id'      => DBModels::type('integer'),
    'is_recursive'     => DBModels::type('boolean', false),
    'is_deleted'       => DBModels::type('boolean', false),
    'serial'           => DBModels::type('string'),
    'inventory_number' => DBModels::type('string'),
    'manufacturers_id' => DBModels::type('integer'),
    'states_id'        => DBModels::type('integer'),
    'comment'          => DBModels::type('text'),
);
$table['relationships'] = array(
    'assettypes'    => array(
        'type'  => 'belongsTo',
        'item'  => 'AssetType',
        'field' => 'assettypes_id'),
    'manufacturers' => array(
        'type' => 'belongsTo',
        'item' => 'Manufacturer',
        'field' => 'manufacturers_id')
);