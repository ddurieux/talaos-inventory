<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Location',
    'menu'          => 'Dropdown'
);
$table['fields'] = array(
    'id'               => DBModels::type('increments',
                                         array('visible' => false)),
    'name'             => DBModels::type('string'),
    'comment'          => DBModels::type('text'),
    'entity_id'        => DBModels::type('integer'), ///TODO create relation
    'is_recursive'     => DBModels::type('boolean',
                                         array('visible' => false)),
    'location_id'      => DBModels::type('integer'),
    'completename'     => DBModels::type('text',
                                         array('visible' => false)),
    'level'            => DBModels::type('integer',
                                         array('visible' => false)),
    'ancestors_cache'  => DBModels::type('longtext',
                                         array('visible' => false)),
    'sons_cache'       => DBModels::type('longtext',
                                         array('visible' => false)),
    'building'         => DBModels::type('string'),
    'room'             => DBModels::type('string'),
    'latitude'         => DBModels::type('string'),
    'longitude'        => DBModels::type('string'),
    'altitude'         => DBModels::type('string'),
);

$table['relationships'] = array(
    'location'        => array(
        'type'  => 'belongsTo',
        'item'  => 'Location'),
    'locationschild'   => array(
        'type'  => 'hasMany',
        'item'  => 'Location'),

);