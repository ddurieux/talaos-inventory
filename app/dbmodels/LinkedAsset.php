<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'LinkedAsset',
    'menu'          => ''
);

$table['fields'] = array(
    'id'               => DBModels::type('increments', 
                                         array('visible' => false)),
    'asset_id_1'       => DBModels::type('integer'),
    'asset_id_2'       => DBModels::type('integer'),
);


