<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'LinkedContract',
    'menu'          => ''
);
$table['fields'] = array(
    'id'          => DBModels::type('increments', 
                                    array('visible' => false)),
    'contract_id' => DBModels::type('integer'),
    'item_type'    => DBModels::type('string', 
                                    array('visible' => false,
                                        'size'    => 100)),
    'item_id'     => DBModels::type('integer', 
                                    array('visible' => false)),
);

