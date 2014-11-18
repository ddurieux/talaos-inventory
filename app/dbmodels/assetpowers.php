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
    'id'               => DBModels::type('increments', 
                                         array('visible' => false)),
    'assets_id'        => DBModels::type('integer', 
                                         array('visible' => false)),
    'powertypes_id'    => DBModels::type('integer'),
    'energytypes_id'   => DBModels::type('integer'),
    'is_redondant'     => DBModels::type('boolean'),
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
