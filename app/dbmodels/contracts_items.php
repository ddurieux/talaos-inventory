<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => '',
    'menu'          => ''
);
$table['fields'] = array(
    'id'      => DBModels::type('increments', 
                                array('visible' => false)),
    'contracts_id' => DBModels::type('integer'),
    'itemtype'              => DBModels::type('string', 
                                              array('visible' => false,
                                                    'size'    => 100)),
    'items_id'              => DBModels::type('integer', 
                                              array('visible' => false)),
);


