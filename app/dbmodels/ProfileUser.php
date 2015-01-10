<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'ProfileUser',
    'menu'          => 'Management'
);
$table['fields'] = array(
    'id'               => DBModels::type('increments',
                                         array('visible' => false)),
    'user_id'          => DBModels::type('integer',
                                         array('visible' => false)),
    'profile_id'       => DBModels::type('integer',
                                         array('visible' => false)),
    'is_dynamic'       => DBModels::type('boolean',
                                         array('visible' => false)),
);

$table['relationships'] = array(
    'profile'    => array(
        'type'  => 'belongsTo',
        'item'  => 'Profile'),
    'user'    => array(
        'type'  => 'belongsTo',
        'item'  => 'User')
);

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";