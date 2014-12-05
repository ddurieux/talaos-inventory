<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'AssetDisk',
    'menu'          => ''
);
$table['fields'] = array(
    'id'               => DBModels::type('increments', 
                                         array('visible' => false)),
    'asset_id'        => DBModels::type('integer', 
                                         array('visible' => false)),
    'name'             => DBModels::type('string'),
    'device'           => DBModels::type('string'),
    'mountpoint'       => DBModels::type('string'),
    'file_system_id'    => DBModels::type('integer'),
    'totalsize'        => DBModels::type('integer'),
    'freesize'         => DBModels::type('integer'),
    'is_deleted'       => DBModels::type('boolean'),
    'is_dynamic'       => DBModels::type('boolean'),
);

$table['relationships'] = array(
    'asset'     => array(
        'type'  => 'belongsTo',
        'item'  => 'Asset'),
    'filesystem'  => array(
        'type'  => 'belongsTo',
        'item'  => 'FileSystem'),
);
