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
    'power_type_id'    => DBModels::type('integer'),
    'energy_type_id'   => DBModels::type('integer'),
    'is_redondant'     => DBModels::type('boolean'),
);
$table['relationships'] = array(
    'asset'        => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'power_type'    => array(
        'type'  => 'belongsTo',
        'item'  => 'PowerType'),
    'energy_type'   => array(
        'type'  => 'belongsTo',
        'item'  => 'EnergyType'),
);
