<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'AssetPrinter',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                  => DBModels::type('increments', 
                                            array('visible' => false)),
    'asset_id'            => DBModels::type('integer', 
                                            array('visible' => false)),
    'printer_type_id'      => DBModels::type('integer'),
    'printer_model_id'     => DBModels::type('integer'),
    'init_pages_counter'  => DBModels::type('integer'),
    'last_pages_counter'  => DBModels::type('integer'),
);

$table['relationships'] = array(
    'asset'        => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'printertype'    => array(
        'type'  => 'belongsTo',
        'item'  => 'PrinterType'),
    'printermodel'   => array(
        'type'  => 'belongsTo',
        'item'  => 'PrinterMoel'),
);
