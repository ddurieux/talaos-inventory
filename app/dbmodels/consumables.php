<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Consumable',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                 => DBModels::type('increments',
                                           array('visible' => false)),
    'entity_id'          => DBModels::type('integer'), ///TODO create relation
    'is_recursive'       => DBModels::type('boolean',
                                            array('visible' => false)),
    'consumableitem_id'  => DBModels::type('integer'),
    'date_in'            => DBModels::type('date'),
    'date_out'           => DBModels::type('date'),
    'item_type'           => DBModels::type('string', 
                                           array('visible' => false,
                                                 'size'    => 100)), /// User or Group ? Define both relations ?
    'item_id'            => DBModels::type('integer', 
                                           array('visible' => false)),
);

$table['relationships'] = array(
    'consumableitem' => array(
        'type' => 'belongsTo',
        'item' => 'ConsumableItem'),
    'asset' => array(
        'type' => 'belongsTo',
        'item' => 'Asset'),
);
