<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'NetworkName',
    'menu'          => ''
);
$table['fields'] = array(
    'id'               => DBModels::type('increments',
                                         array('visible' => false)),
    'item_type'        => DBModels::type('string',
                                        array('visible' => false,
                                              'size'    => 100)),
    'item_id'          => DBModels::type('integer',
                                         array('visible' => false)),
    'name'             => DBModels::type('string'),
    'is_deleted'       => DBModels::type('boolean',
                                         array('visible' => false)),
    'is_dynamic'       => DBModels::type('boolean',
                                         array('visible' => false)),
    'comment'          => DBModels::type('text'),
    'fqdn_id'         => DBModels::type('integer'),
);

$table['relationships']['fqdn'] = array(
        'type'      => 'belongsTo',
        'item'      => 'Fqdn');
$table['relationships']['item'] = array(
        'type'      => 'morphTo');

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";