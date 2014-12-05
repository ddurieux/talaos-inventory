<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Supplier',
    'menu'          => 'Management'
);
$table['fields'] = array(
    'id'                 => DBModels::type('increments',
                                           array('visible' => false)),
    'name'               => DBModels::type('string'),
    'comment'            => DBModels::type('text'),
    'is_deleted'         => DBModels::type('boolean',
                                           array('visible' => false)),
    'supplier_type_id'    => DBModels::type('integer'),
    'address'            => DBModels::type('text'),
    'postcode'           => DBModels::type('string'),
    'town'               => DBModels::type('string'),
    'state'              => DBModels::type('string'),
    'country'            => DBModels::type('string'),
    'website'            => DBModels::type('string'),
    'phonenumber'        => DBModels::type('string'),
    'fax'                => DBModels::type('string'),
    'email'              => DBModels::type('string'),

);

$table['relationships'] = array(
    'supplier_type_id' => array(
        'type' => 'belongsTo',
        'item' => 'SupplierType'),
    'entity' => array(
        'type'  => 'belongsTo',
        'item'  => 'Entity'),
);
include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";