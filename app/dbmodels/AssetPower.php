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
    'asset_id'        => DBModels::type('integer', 
                                         array('visible' => false)),
    'powertype_id'    => DBModels::type('integer'),
    'energytype_id'   => DBModels::type('integer'),
    'is_redondant'     => DBModels::type('boolean'),
);
$table['relationships'] = array(
    'asset'        => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'powertype'    => array(
        'type'  => 'belongsTo',
        'item'  => 'PowerType'),
    'energytype'   => array(
        'type'  => 'belongsTo',
        'item'  => 'EnergyType'),
);
