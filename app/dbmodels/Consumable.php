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
    'consumable_item_id'  => DBModels::type('integer'),
    'date_in'            => DBModels::type('date'),
    'date_out'           => DBModels::type('date'),
    'item_type'           => DBModels::type('string',
                                           array('visible' => false,
                                                 'size'    => 100)), /// User or Group ? Define both relations ?
    'item_id'            => DBModels::type('integer',
                                           array('visible' => false)),
);

$table['relationships'] = array(
    'consumable_item' => array(
        'type' => 'belongsTo',
        'item' => 'ConsumableItem'),
    'infocom' => array(
        'type' => 'morphMany',
        'item' => 'Infocom'),
    'receiver' => array(
        'type' => 'morphTo'),
);
include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";