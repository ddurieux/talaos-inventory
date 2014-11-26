<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'CompatiblePrinterModel',
    'menu'          => ''
);

$table['fields'] = array(
    'id'          => DBModels::type('increments', 
                                    array('visible' => false)),
    'cartridgeitem_id' => DBModels::type('integer'),
    'printermodel_id'     => DBModels::type('integer', 
                                    array('visible' => false)),
);


