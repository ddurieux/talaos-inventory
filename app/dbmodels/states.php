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
    'state_id'                        => DBModels::type('integer'),
    'completename'                    => DBModels::type('text',
                                                        array('visible' => false)),
    'level'                           => DBModels::type('integer',
                                                        array('visible' => false)),
    'ancestors_cache'                 => DBModels::type('longText',
                                                        array('visible' => false)),
    'sons_cache'                      => DBModels::type('longText',
                                                        array('visible' => false))
);

$table['relationships'] = array(
    'state' => array(
        'type' => 'belongsTo',
        'item' => 'State')
);