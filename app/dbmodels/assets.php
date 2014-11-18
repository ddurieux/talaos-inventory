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
    'groups_id'        => DBModels::type('integer'),
    'groups_id_tech'   => DBModels::type('integer'),
);

$table['relationships'] = array(
    'assets'    => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset',
        'field' => 'assets_id'),
    'assetschild'   => array(
        'type'  => 'hasMany',
        'item'  => 'Asset',
        'field' => 'assets_id'),
    'assettypes'    => array(
        'type'  => 'belongsTo',
        'item'  => 'AssetType',
        'field' => 'assetypes_id'),
    'contracts' => array(
        'type' => 'belongsToMany',
        'item' => 'Contract',
        'linktable' => 'glpi_contracts_items',
        'field1' => 'contracts_id',
        'field2' => 'items_id',
        'condition' => array('itemtype','=','Asset')),
    'groups_id' => array(
        'type' => 'belongsTo',
        'item' => 'Group'),
    'groups_id_tech' => array(
        'type'  => 'belongsTo',
        'item'  => 'Group',
        'field' => 'groups_id_tech'),
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
