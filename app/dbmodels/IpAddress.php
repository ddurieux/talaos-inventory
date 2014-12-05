<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'IpAddress',
    'menu'          => ''
);
$table['fields'] = array(
    'id'               => DBModels::type('increments',
                                         array('visible' => false)),
    'name'             => DBModels::type('string'),
    'entity_id'        => DBModels::type('integer'),
    'is_recursive'     => DBModels::type('boolean',
                                         array('visible' => false)),
    'is_deleted'       => DBModels::type('boolean',
                                         array('visible' => false)),
    'is_dynamic'       => DBModels::type('boolean',
                                         array('visible' => false)),
    'item_type'        => DBModels::type('string',
                                        array('visible' => false,
                                              'size'    => 100)),
    'item_id'          => DBModels::type('integer',
                                         array('visible' => false)),
    'main_item_type'        => DBModels::type('string',
                                        array('visible' => false,
                                              'size'    => 100)),
    'main_item_id'          => DBModels::type('integer',
                                         array('visible' => false)),
    'version'          => DBModels::type('integer'),
    'binary_0'         => DBModels::type('integer'),
    'binary_1'         => DBModels::type('integer'),
    'binary_2'         => DBModels::type('integer'),
    'binary_3'         => DBModels::type('integer'),

);

$table['relationships']['ip_networks'] = array(
        'type'      => 'belongsToMany',
        'item'      => 'IpNetwork',
        'linktable' => 'linked_ip_networks');

$table['relationships']['entity'] = array(
        'type'      => 'belongsTo',
        'item'      => 'Entity');
