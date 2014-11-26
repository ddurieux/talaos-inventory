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
    'id'               => DBModels::type('increments', 
                                         array('visible' => false)),
    'asset_id'         => DBModels::type('integer'),
    'devicecontrol_id' => DBModels::type('integer'),
    'entity_id'        => DBModels::type('integer'), ///TODO create relation
    'is_recursive'     => DBModels::type('boolean',
                                         array('visible' => false)),
    'is_deleted'       => DBModels::type('boolean',
                                         array('visible' => false)),
    'is_dynamic'       => DBModels::type('boolean',
                                         array('visible' => false)),
    'serial'           => DBModels::type('string'),
    'busID'            => DBModels::type('string'),
);


$table['relationships'] = array(
    'asset' => array(
        'type' => 'belongsTo',
        'item' => 'Asset'),
    'devicecontrol' => array(
        'type' => 'belongsTo',
        'item' => 'DeviceControl'),
    'contracts' => array(
        'type'      => 'morphToMany',
        'item'      => 'Contract',
        'table'     => 'glpi_contracts_items'),
    'documents' => array(
        'type'      => 'morphToMany',
        'item'      => 'Document',
        'table'     => 'glpi_documents_items'),
    'infocom' => array(
        'type' => 'morphMany',
        'item' => 'Infocom'),    
);
