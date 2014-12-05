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
    'asset_id'        => DBModels::type('integer', 
                                         array('visible' => false)),
    'size'             => DBModels::type('integer'),
    'display_type_id'  => DBModels::type('integer'),
    'display_model_id' => DBModels::type('integer'),
    'have_subd'        => DBModels::type('boolean'),
    'have_bnc'         => DBModels::type('boolean'),
    'have_vga'         => DBModels::type('boolean'),
    'have_dvi'         => DBModels::type('boolean'),
    'have_displayport' => DBModels::type('boolean'),
);

$table['relationships'] = array(
    'asset'     => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'display_type'  => array(
        'type'  => 'belongsTo',
        'item'  => 'DisplayType'),
    'display_model'  => array(
        'type'  => 'belongsTo',
        'item'  => 'DisplayModel')
);
