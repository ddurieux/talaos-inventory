<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'PrinterType',
    'menu'          => 'Dropdown'
);
$table['fields'] = array(
    'id'      => DBModels::type('increments', 
                                array('visible' => false)),
    'name'    => DBModels::type('string'),
    'comment' => DBModels::type('text'),
);

