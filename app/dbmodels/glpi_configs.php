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
    'version' => DBModels::type('string'),
);


