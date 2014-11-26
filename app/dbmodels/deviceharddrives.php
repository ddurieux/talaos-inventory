<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'DeviceHardDrive',
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
    'rpm'                   => DBModels::type('string'),
    'cache'                 => DBModels::type('string'),
    'cache_default'         => DBModels::type('integer'),
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
