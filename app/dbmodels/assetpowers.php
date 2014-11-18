<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'AssetPower',
    'menu'          => ''
);
$table['fields'] = array(
    'id'               => DBModels::type('increments'),
    'assets_id'        => DBModels::type('integer'),
    'powertypes_id'    => DBModels::type('integer', 
                                         array('visible' => true)),
    'energytypes_id'   => DBModels::type('integer', 
                                         array('visible' => true)),
    'is_redondant'     => DBModels::type('boolean', 
                                         array('visible' => true)),
);
$table['relationships'] = array(
    'assets'        => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'powertypes'    => array(
        'type'  => 'belongsTo',
        'item'  => 'PowerType'),
    'energytypes'   => array(
        'type'  => 'belongsTo',
        'item'  => 'EnergyType'),
);
