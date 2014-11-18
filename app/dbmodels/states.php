<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'State',
    'menu'          => 'Dropdown'
);
$table['fields'] = array(
    'id'                              => DBModels::type('increments',
                                                        array('visible' => false)),
    'name'                            => DBModels::type('string'),
    'comment'                         => DBModels::type('text'),
    'states_id'                       => DBModels::type('integer'),
    'completename'                    => DBModels::type('text'),
    'level'                           => DBModels::type('integer'),
    'ancestors_cache'                 => DBModels::type('longText',
                                                        array('visible' => false)),
    'sons_cache'                      => DBModels::type('longText',
                                                        array('visible' => false))
);

$table['relationships'] = array(
    'states' => array(
        'type' => 'belongsTo',
        'item' => 'State')
);