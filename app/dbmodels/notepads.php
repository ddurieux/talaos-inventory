<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Infocom',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                    => DBModels::type('increments', 
                                              array('visible' => false)),
    'itemtype'              => DBModels::type('string', 
                                              array('visible' => false,
                                                    'size'    => 100)),
    'items_id'              => DBModels::type('integer', 
                                              array('visible' => false)),
    'users_id'              => DBModels::type('integer'),
    'users_id_lastupdater'  => DBModels::type('integer'),
    'content'               => DBModels::type('longtext'),
    
                                         
);
  
  
$table['relationships'] = array(
    'users_id' => array(
        'type' => 'belongsTo',
        'item' => 'User'),
    'users_id_lastupdater' => array(
        'type' => 'belongsTo',
        'item' => 'User'),
);
