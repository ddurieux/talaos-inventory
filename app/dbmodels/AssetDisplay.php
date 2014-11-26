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
    'displaytype_id'  => DBModels::type('integer'),
    'displaymodel_id' => DBModels::type('integer'),
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
    'displaytype'  => array(
        'type'  => 'belongsTo',
        'item'  => 'DisplayType'),
    'modeltype'  => array(
        'type'  => 'belongsTo',
        'item'  => 'ModelType')
);
