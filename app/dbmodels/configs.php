<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Config',
    'menu'          => ''
);
$table['fields'] = array(
    'id'      => DBModels::type('increments', 
                                array('visible' => false)),
    'version' => DBModels::type('string'),
);


