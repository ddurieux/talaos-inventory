<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'visible'       => array()
);
$table['fields'] = array(
    'id'      => DBModels::type('increments'),
    'name'    => DBModels::type('string'),
    'comment' => DBModels::type('text'),
);

