<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Asset',
    'menu'          => 'Asset'
);
$table['fields'] = array(
    'id'               => DBModels::type('increments', 
                                         array('visible' => false)),
    'name'             => DBModels::type('string'),
    'assettypes_id'    => DBModels::type('integer', 
                                         array('visible' => false)),
    'entities_id'      => DBModels::type('integer'),
    'is_recursive'     => DBModels::type('boolean', 
                                         array('visible' => false)),
    'is_deleted'       => DBModels::type('boolean', 
                                         array('visible' => false)),
    'serial'           => DBModels::type('string'),
    'inventory_number' => DBModels::type('string'),
    'manufacturers_id' => DBModels::type('integer'),
    'states_id'        => DBModels::type('integer'),
    'comment'          => DBModels::type('text'),
    'assets_id'        => DBModels::type('integer'),
    'users_id'         => DBModels::type('integer'),
    'users_id_tech'    => DBModels::type('integer'),
);
///TODO : Add groups : contacts / technicians 

$table['relationships'] = array(
    'assets'        => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset',
        'field' => 'assets_id'),
    'assetschild'   => array(
        'type'  => 'hasMany',
        'item'  => 'Asset',
        'field' => 'assets_id'),
    'assettypes'    => array(
        'type'  => 'belongsTo',
        'item'  => 'AssetType'),
    'manufacturers' => array(
        'type' => 'belongsTo',
        'item' => 'Manufacturer'),
    'users_id' => array(
        'type' => 'belongsTo',
        'item' => 'User'),
    'users_id_tech' => array(
        'type'  => 'belongsTo',
        'item'  => 'User',
        'field' => 'users_id_tech'),
        
);
