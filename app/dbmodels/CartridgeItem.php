<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'CartridgeItem',
    'menu'          => 'Asset'
);
$table['fields'] = array(
    'id'                    => DBModels::type('increments',
                                              array('visible' => false)),
    'name'                  => DBModels::type('string'),
    'is_deleted'            => DBModels::type('boolean',
                                              array('visible' => false)),
    'manufacturer_id'       => DBModels::type('integer'),
    'comment'               => DBModels::type('text'),
    'location_id'           => DBModels::type('integer'),
    'user_tech_id'          => DBModels::type('integer'),
    'group_tech_id'         => DBModels::type('integer'),
    'cartridge_item_type_id' => DBModels::type('integer'),
    'alarm_threshold'       => DBModels::type('integer', array('defaut'=>10)),
);

$table['relationships'] = array(
    'cartridge_item_type' => array(
        'type' => 'belongsTo',
        'item' => 'CartridgeItemType'),
    'cartridges'   => array(
        'type'  => 'hasMany',
        'item'  => 'Cartridge',),
    'contracts' => array(
        'type'      => 'morphToMany',
        'item'      => 'Contract',
        'table'     => 'linked_contracts'),
    'documents' => array(
        'type'      => 'morphToMany',
        'item'      => 'Document',
        'table'     => 'linked_documents'),
    'infocom' => array(
        'type' => 'morphMany',
        'item' => 'Infocom'),
    'group_tech' => array(
        'type'  => 'belongsTo',
        'item'  => 'Group'),
    'location' => array(
        'type' => 'belongsTo',
        'item' => 'Location'),
    'manufacturer' => array(
        'type' => 'belongsTo',
        'item' => 'Manufacturer'),
    'printermodels' => array(
        'type'      => 'belongsToMany',
        'item'      => 'PrinterModel',
        'linktable' => 'cartridge_compatibilities'),
    'user_tech' => array(
        'type'  => 'belongsTo',
        'item'  => 'User'),
);

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";