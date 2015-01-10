<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'ProfileRight',
    'menu'          => 'Management'
);
$table['fields'] = array(
    'id'               => DBModels::type('increments',
                                         array('visible' => false)),
    'profile_id'       => DBModels::type('integer',
                                         array('visible' => false)),
    'name'             => DBModels::type('string'),
    'rights'           => DBModels::type('integer'),
);

$table['relationships'] = array(
    'profile'    => array(
        'type'  => 'belongsTo',
        'item'  => 'Profile')
);
