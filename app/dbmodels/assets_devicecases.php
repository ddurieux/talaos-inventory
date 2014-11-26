<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => '',
    'menu'          => ''
);

$table['fields'] = array(
    'id'              => DBModels::type('increments', 
                                        array('visible' => false)),
    'asset_id'        => DBModels::type('integer'),
    'devicecase_id'   => DBModels::type('integer'),
    'entity_id'       => DBModels::type('integer'), ///TODO create relation
    'is_recursive'    => DBModels::type('boolean',
                                        array('visible' => false)),
    'is_deleted'      => DBModels::type('boolean',
                                        array('visible' => false)),
    'is_dynamic'      => DBModels::type('boolean',
                                        array('visible' => false)),
    'serial'          => DBModels::type('string'),
);


$table['relationships'] = array(
    'asset' => array(
        'type' => 'belongsTo',
        'item' => 'Asset'),
    'devicecase' => array(
        'type' => 'belongsTo',
        'item' => 'DeviceCase'),
    'contracts' => array(
        'type'      => 'belongsToMany',
        'item'      => 'Contract',
        'linktable' => 'glpi_contracts_items',
        'field1'    => 'contract_id',
        'field2'    => 'item_id',
        'condition' => array('itemtype','=','CartridgeItem')),
    'documents' => array(
        'type' => 'belongsToMany',
        'item' => 'Document',
        'linktable' => 'glpi_documents_items',
        'field1' => 'document_id',
        'field2' => 'item_id',
        'condition' => array('itemtype','=','CartridgeItem')),
    'infocoms' => array(
        'type'      => 'hasOne',
        'item'      => 'Infocom',
        'field'     => 'item_id',
        'condition' => array('itemtype','=','Asset_DeviceCase')),        
);