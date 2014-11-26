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
    'id'          => DBModels::type('increments', 
                                    array('visible' => false)),
    'document_id' => DBModels::type('integer'),
    'item_type'    => DBModels::type('string', 
                                    array('visible' => false,
                                        'size'    => 100)),
    'item_id'     => DBModels::type('integer', 
                                    array('visible' => false)),
);


