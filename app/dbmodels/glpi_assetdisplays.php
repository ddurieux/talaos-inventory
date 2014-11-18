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
    'id'               => DBModels::type('increments'),
    'assets_id'        => DBModels::type('integer'),
    'size'             => DBModels::type('integer', 
                                         array('visible' => true)),
    'displaytypes_id'  => DBModels::type('integer', 
                                         array('visible' => true)),
    'displaymodels_id' => DBModels::type('integer', 
                                         array('visible' => true)),
    'have_subd'        => DBModels::type('boolean', 
                                         array('visible' => true)),
    'have_bnc'         => DBModels::type('boolean', 
                                         array('visible' => true)),
    'have_vga'         => DBModels::type('boolean', 
                                         array('visible' => true)),
    'have_dvi'         => DBModels::type('boolean', 
                                         array('visible' => true)),
    'have_displayport' => DBModels::type('boolean', 
                                         array('visible' => true)),
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
