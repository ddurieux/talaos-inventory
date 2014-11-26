<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'DeviceCase',
    'menu'          => 'Configuration'
);
$table['fields'] = array(
    'id'                    => DBModels::type('increments',
                                              array('visible' => false)),
    'name'                  => DBModels::type('string'),
    'entity_id'             => DBModels::type('integer'), ///TODO create relation
    'is_recursive'          => DBModels::type('boolean',
                                              array('visible' => false)),
    'manufacturer_id'       => DBModels::type('integer'),
    'devicecasetype_id'     => DBModels::type('integer'),
    'comment'               => DBModels::type('text'),
);


$table['relationships'] = array(
    'devicecasetype' => array(
        'type' => 'belongsTo',
        'item' => 'DeviceCaseType'),
    'documents' => array(
        'type' => 'belongsToMany',
        'item' => 'Document',
        'linktable' => 'glpi_documents_items',
        'field1' => 'document_id',
        'field2' => 'item_id',
        'condition' => array('item_type','=','DeviceCase')),
    'manufacturer' => array(
        'type' => 'belongsTo',
        'item' => 'Manufacturer'),
);
