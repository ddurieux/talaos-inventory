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
    'asset_type_id'     => DBModels::type('integer',
                                         array('visible' => false)),
    'is_deleted'       => DBModels::type('boolean',
                                         array('visible' => false)),
    'is_dynamic'       => DBModels::type('boolean',
                                         array('visible' => false)),
    'serial'           => DBModels::type('string'),
    'inventory_number' => DBModels::type('string'),
    'manufacturer_id'  => DBModels::type('integer'),
    'location_id'      => DBModels::type('integer'),
    'state_id'         => DBModels::type('integer'),
    'comment'          => DBModels::type('text'),
    'asset_id'         => DBModels::type('integer'),
    'user_id'          => DBModels::type('integer'),
    'user_tech_id'     => DBModels::type('integer'),
    'group_id'         => DBModels::type('integer'),
    'group_tech_id'    => DBModels::type('integer'),
);

$table['relationships'] = array(
    'asset'    => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'assetschild'   => array(
        'type'  => 'hasMany',
        'item'  => 'Asset'),
    'assetdisks'   => array(
        'type'  => 'hasMany',
        'item'  => 'AssetDisk'),
    'assetdisplays'   => array(
        'type'  => 'hasOne',
        'item'  => 'AssetDisplay'),
    'assetpowers'   => array(
        'type'  => 'hasOne',
        'item'  => 'AssetPower'),
    'assetprinters'   => array(
        'type'  => 'hasOne',
        'item'  => 'AssetPrinter'),
    'assettype'    => array(
        'type'  => 'belongsTo',
        'item'  => 'AssetType'),
    'cartridges'   => array(
        'type'  => 'hasMany',
        'item'  => 'Cartridge',
        'field' => 'asset_id'),
    'contracts' => array(
        'type'      => 'morphToMany',
        'item'      => 'Contract',
        'table'     => 'linked_contracts'),
    'documents' => array(
        'type'      => 'morphToMany',
        'item'      => 'Document',
        'table'     => 'linked_documents'),
    'group' => array(
        'type' => 'belongsTo',
        'item' => 'Group'),
    'group_tech' => array(
        'type' => 'belongsTo',
        'item' => 'Group'),
    'infocom' => array(
        'type' => 'morphMany',
        'item' => 'Infocom'),
    'location' => array(
        'type' => 'belongsTo',
        'item' => 'Location'),
    'manufacturer' => array(
        'type' => 'belongsTo',
        'item' => 'Manufacturer'),
    'user' => array(
        'type' => 'belongsTo',
        'item' => 'User'),
    'user_tech' => array(
        'type' => 'belongsTo',
        'item' => 'User'),
    'state' => array(
        'type'  => 'belongsTo',
        'item'  => 'State'),
);

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";