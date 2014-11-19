<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Cartridge',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                 => DBModels::type('increments',
                                           array('visible' => false)),
    'entity_id'          => DBModels::type('integer'), ///TODO create relation
    'cartridgeitem_id'   => DBModels::type('integer'),
    'asset_id'           => DBModels::type('integer'),
    'date_in'            => DBModels::type('date'),
    'date_use'           => DBModels::type('date'),
    'date_out'           => DBModels::type('date'),
    'pages'              => DBModels::type('integer'),
);


$table['relationships'] = array(
    'cartridgeitem' => array(
        'type' => 'belongsTo',
        'item' => 'CartridgeItem'),
    'asset' => array(
        'type' => 'belongsTo',
        'item' => 'Asset'),
);