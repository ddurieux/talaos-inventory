<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'DocumentCategory',
    'menu'          => 'Dropdown'
);
$table['fields'] = array(
    'id'                  => DBModels::type('increments', 
                                            array('visible' => false)),
    'name'                => DBModels::type('string'),
    'comment'             => DBModels::type('text'),
    'documentcategory_id' => DBModels::type('integer'),
    'completename'     => DBModels::type('text', 
                                         array('visible' => false)),
    'level'            => DBModels::type('integer', 
                                         array('visible' => false)),
    'ancestors_cache'  => DBModels::type('longtext', 
                                         array('visible' => false)),
    'sons_cache'       => DBModels::type('longtext', 
                                         array('visible' => false)),
);

$table['relationships'] = array(
    'documentcategory'        => array(
        'type'  => 'belongsTo',
        'item'  => 'DocumentCategory'),
    'documentcategorieschild'   => array(
        'type'  => 'hasMany',
        'item'  => 'DocumentCategory',
        'field' => 'documentcategory_id'),
        
);