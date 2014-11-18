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
    'assettype_id'    => DBModels::type('integer', 
                                         array('visible' => false)),
    'entity_id'      => DBModels::type('integer'),
    'is_recursive'     => DBModels::type('boolean', 
                                         array('visible' => false)),
    'is_deleted'       => DBModels::type('boolean', 
                                         array('visible' => false)),
    'serial'           => DBModels::type('string'),
    'inventory_number' => DBModels::type('string'),
    'manufacturer_id' => DBModels::type('integer'),
    'state_id'        => DBModels::type('integer'),
    'comment'          => DBModels::type('text'),
    'asset_id'        => DBModels::type('integer'),
    'user_id'         => DBModels::type('integer'),
    'user_tech_id'    => DBModels::type('integer'),
    'group_id'        => DBModels::type('integer'),
    'group_tech_id'   => DBModels::type('integer'),
);

$table['relationships'] = array(
    'asset'    => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'assetschild'   => array(
        'type'  => 'hasMany',
        'item'  => 'Asset',
        'field' => 'asset_id'),
    'assettype'    => array(
        'type'  => 'belongsTo',
        'item'  => 'AssetType'),
    'contracts' => array(
        'type' => 'belongsToMany',
        'item' => 'Contract',
        'linktable' => 'glpi_contracts_items',
        'field1' => 'contract_id',
        'field2' => 'item_id',
        'condition' => array('itemtype','=','Asset')),
    'documents' => array(
        'type' => 'belongsToMany',
        'item' => 'Document',
        'linktable' => 'glpi_documents_items',
        'field1' => 'document_id',
        'field2' => 'item_id',
        'condition' => array('itemtype','=','Asset')),
    'group' => array(
        'type' => 'belongsTo',
        'item' => 'Group'),
    'group_tech' => array(
        'type'  => 'belongsTo',
        'item'  => 'Group'),
    'manufacturer' => array(
        'type' => 'belongsTo',
        'item' => 'Manufacturer'),
    'user' => array(
        'type' => 'belongsTo',
        'item' => 'User'),
    'user_tech' => array(
        'type'  => 'belongsTo',
        'item'  => 'User'),
        
);
