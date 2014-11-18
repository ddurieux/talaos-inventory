<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'AssetDisplay',
    'menu'          => ''
);
$table['fields'] = array(
    'id'               => DBModels::type('increments', 
                                         array('visible' => false)),
    'assets_id'        => DBModels::type('integer', 
                                         array('visible' => false)),
    'size'             => DBModels::type('integer'),
    'displaytypes_id'  => DBModels::type('integer'),
    'displaymodels_id' => DBModels::type('integer'),
    'have_subd'        => DBModels::type('boolean'),
    'have_bnc'         => DBModels::type('boolean'),
    'have_vga'         => DBModels::type('boolean'),
    'have_dvi'         => DBModels::type('boolean'),
    'have_displayport' => DBModels::type('boolean'),
);
$table['relationships'] = array(
    'assets'        => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'displaytypes'  => array(
        'type'  => 'belongsTo',
        'item'  => 'DisplayType'),
    'modeltypes'  => array(
        'type'  => 'belongsTo',
        'item'  => 'ModelType')
);
