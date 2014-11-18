<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'visible'       => array(),
    'model'         => 'Manufacturer',
    'menu'          => 'Dropdown'
);
$table['fields'] = array(
    'id'      => DBModels::type('increments'),
    'name'    => DBModels::type('string'),
    'comment' => DBModels::type('text'),
);

$table['visible'] = array('name', 'comment');



