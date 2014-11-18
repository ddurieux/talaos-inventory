<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Manufacturer',
    'menu'          => 'Dropdown'
);
$table['fields'] = array(
    'id'      => DBModels::type('increments'),
    'name'    => DBModels::type('string', 
                                array('visible' => true)),
    'comment' => DBModels::type('text', 
                                array('visible' => true)),
);



