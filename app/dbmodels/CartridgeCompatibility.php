<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'CartridgeCompatibility',
    'menu'          => ''
);

$table['fields'] = array(
    'id'          => DBModels::type('increments', 
                                    array('visible' => false)),
    'cartridge_item_id' => DBModels::type('integer'),
    'printer_model_id'     => DBModels::type('integer'),
);


