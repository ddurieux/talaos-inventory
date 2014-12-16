<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'LinkedIpNetwork',
    'menu'          => ''
);

$table['fields'] = array(
    'id'               => DBModels::type('increments', 
                                         array('visible' => false)),
    'ip_address_id'     => DBModels::type('integer'),
    'ip_network_id'    => DBModels::type('integer'),
);


