<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Blacklist',
    'menu'          => 'Dropdown'
);
$table['fields'] = array(
    'id'      => DBModels::type('increments',
                                array('visible' => false)),
    'type'    => DBModels::type('integer'),
    'name'    => DBModels::type('string'),
    'value'   => DBModels::type('string'),
    'comment' => DBModels::type('text'),
);



