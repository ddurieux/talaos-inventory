<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'DeviceGraphicCard',
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
    'comment'               => DBModels::type('text'),
    'interfacetype_id'      => DBModels::type('integer'),
    'memory_default'        => DBModels::type('integer'),
    'chipset'               => DBModels::type('string'),
);

  
$table['relationships'] = array(
    'interfacetype' => array(
        'type' => 'belongsTo',
        'item' => 'InterfaceType'),
    'documents' => array(
        'type'      => 'morphToMany',
        'item'      => 'Document',
        'table'     => 'glpi_documents_items'),
    'manufacturer' => array(
        'type' => 'belongsTo',
        'item' => 'Manufacturer'),
);
