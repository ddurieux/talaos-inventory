<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'ConsumableItem',
    'menu'          => 'Asset'
);
$table['fields'] = array(
    'id'                    => DBModels::type('increments',
                                              array('visible' => false)),
    'name'                  => DBModels::type('string'),
    'ref'                   => DBModels::type('string'),
    'entity_id'             => DBModels::type('integer'), ///TODO create relation
    'is_recursive'          => DBModels::type('boolean',
                                              array('visible' => false)),
    'is_deleted'            => DBModels::type('boolean',
                                              array('visible' => false)),                                              
    'manufacturer_id'       => DBModels::type('integer'),
    'comment'               => DBModels::type('text'),
    'location_id'           => DBModels::type('integer'),
    'user_tech_id'          => DBModels::type('integer'),
    'group_tech_id'         => DBModels::type('integer'),
    'consumableitemtype_id' => DBModels::type('integer'),
    'alarm_threshold'       => DBModels::type('integer', array('defaut'=>10)),
);


  
$table['relationships'] = array(
    'consumableitemtype' => array(
        'type' => 'belongsTo',
        'item' => 'ConsumableItemType'),
    'consumables'   => array(
        'type'  => 'hasMany',
        'item'  => 'Consumable',
        'field' => 'consumableitem_id'),
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
    'group_tech' => array(
        'type'  => 'belongsTo',
        'item'  => 'Group'),
    'location' => array(
        'type' => 'belongsTo',
        'item' => 'Location'),
    'manufacturer' => array(
        'type' => 'belongsTo',
        'item' => 'Manufacturer'),
    'user_tech' => array(
        'type'  => 'belongsTo',
        'item'  => 'User'),
);