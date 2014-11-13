<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'visible'       => array()
);
$table['fields'] = array(
    'id'               => DBModels::type('increments'),
    'assets_id'        => DBModels::type('integer'),
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
$table['visible'] = array();