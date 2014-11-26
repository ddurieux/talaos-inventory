<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'DeviceDrive',
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
    'is_writer'             => DBModels::type('boolean'),
    'interfacetype_id'      => DBModels::type('integer'),
    'speed'                 => DBModels::type('string'),
    
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
