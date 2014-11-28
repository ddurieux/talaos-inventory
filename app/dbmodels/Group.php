<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Group',
    'menu'          => 'Administration'
);
$table['fields'] = array(
    'id'               => DBModels::type('increments',
                                         array('visible' => false)),
    'name'             => DBModels::type('string'),
    'comment'          => DBModels::type('text'),
    'entity_id'        => DBModels::type('integer'),
    'is_recursive'     => DBModels::type('boolean',
                                         array('visible' => false)),
    'ldap_field'       => DBModels::type('string'),
    'ldap_value'       => DBModels::type('text'),
    'ldap_group_dn'    => DBModels::type('text'),
    'group_id'         => DBModels::type('integer'),
    'completename'     => DBModels::type('text',
                                         array('visible' => false)),
    'level'            => DBModels::type('integer',
                                         array('visible' => false)),
    'ancestors_cache'  => DBModels::type('longtext',
                                         array('visible' => false)),
    'sons_cache'       => DBModels::type('longtext',
                                         array('visible' => false)),
    'is_requester'     => DBModels::type('boolean',
                                         array('default' => 1)),
    'is_assign'        => DBModels::type('boolean',
                                         array('default' => 1)),
    'is_notify'        => DBModels::type('boolean',
                                         array('default' => 1)),
    'is_itemgroup'     => DBModels::type('boolean',
                                         array('default' => 1)),
    'is_usergroup'     => DBModels::type('boolean',
                                         array('default' => 1)),
    'is_manager'       => DBModels::type('boolean',
                                         array('default' => 1)),


);

$table['relationships'] = array(
    'group' => array(
        'type' => 'belongsTo',
        'item' => 'Group'),
    'groupschild'   => array(
        'type'  => 'hasMany',
        'item'  => 'Group'),
    'consumables' => array(
        'type' => 'morphMany',
        'item' => 'Consumable'),
    'entity' => array(
        'type'  => 'belongsTo',
        'item'  => 'Entity'),

);
