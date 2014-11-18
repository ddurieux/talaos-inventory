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
    'entity_id'             => DBModels::type('integer'),
    'is_recursive'          => DBModels::type('boolean', 
                                              array('visible' => false)),
    'is_deleted'            => DBModels::type('boolean', 
                                              array('visible' => false)),
    'manufacturer_id'       => DBModels::type('integer'),
    'comment'               => DBModels::type('text'),
    'location_id'           => DBModels::type('integer'),
    'user_tech_id'          => DBModels::type('integer'),
    'group_tech_id'         => DBModels::type('integer'),
    'cartridgeitemtype_id' => DBModels::type('integer'),
    'alarm_threshold'       => DBModels::type('integer', array('defaut'=>10)),
);

$table['relationships'] = array(
    'cartridgeitemtype' => array(
        'type' => 'belongsTo',
        'item' => 'CartridgeItemType'),
    'cartridges'   => array(
        'type'  => 'hasMany',
        'item'  => 'Cartridge',
        'field' => 'cartridgeitem_id'),
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
        'type' => 'belongsToMany',
        'item' => 'PrinterModel',
        'linktable' => 'glpi_cartridgeitems_printermodels',
        'field1' => 'cartridgeitem_id',
        'field2' => 'printermodel_id'),
    'user_tech' => array(
        'type'  => 'belongsTo',
        'item'  => 'User'),
);
