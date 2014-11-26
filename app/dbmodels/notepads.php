<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Notepad',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                    => DBModels::type('increments', 
                                              array('visible' => false)),
    'item_type'              => DBModels::type('string', 
                                              array('visible' => false,
                                                    'size'    => 100)),
    'item_id'               => DBModels::type('integer', 
                                             array('visible' => false)),
    'user_id'               => DBModels::type('integer'),
    'user_lastupdater_id'   => DBModels::type('integer'),
    'content'               => DBModels::type('longtext'),
    
                                         
);
  
  
$table['relationships'] = array(
    'user_id' => array(
        'type' => 'belongsTo',
        'item' => 'User'),
    'user_lastupdater_id' => array(
        'type' => 'belongsTo',
        'item' => 'User'),
);
