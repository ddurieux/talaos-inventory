<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Software',
    'menu'          => 'Asset'
);
$table['fields'] = array(
    'id'                   => DBModels::type('increments',
                                             array('visible' => false)),
    'name'                 => DBModels::type('string'),
    'comment'              => DBModels::type('text'),
    'is_deleted'           => DBModels::type('boolean',
                                             array('visible' => false)),
    'is_template'          => DBModels::type('boolean',
                                             array('visible' => false)),
    'template_name'        => DBModels::type('string',
                                             array('visible' => false)),
    'user_id'              => DBModels::type('integer'),
    'user_tech_id'         => DBModels::type('integer'),
    'group_id'             => DBModels::type('integer'),
    'group_tech_id'        => DBModels::type('integer'),
    'location_id'          => DBModels::type('integer'),
    'software_id'          => DBModels::type('integer'),
    'softwarecategory_id'  => DBModels::type('integer'),
    'manufacturer_id'      => DBModels::type('integer'),
    'is_update'            => DBModels::type('boolean'),
    'is_helpdesk_visible'  => DBModels::type('boolean'),
    'is_valid'             => DBModels::type('boolean',
                                             array('visible' => false)),
    'ticket_tco'           => DBModels::type('decimal',
                                             array('visible' => false)),
                                      

);

$table['relationships'] = array(
    'group' => array(
        'type' => 'belongsTo',
        'item' => 'Group'),
    'group_tech' => array(
        'type' => 'belongsTo',
        'item' => 'Group'),
    'location' => array(
        'type' => 'belongsTo',
        'item' => 'Location'),
    'manufacturer' => array(
        'type' => 'belongsTo',
        'item' => 'Manufacturer'),
    'software' => array(
        'type' => 'belongsTo',
        'item' => 'Software'),
    'softwarecategory' => array(
        'type' => 'belongsTo',
        'item' => 'SoftwareCategory'),
    'user' => array(
        'type' => 'belongsTo',
        'item' => 'User'),
    'user_tech' => array(
        'type' => 'belongsTo',
        'item' => 'User'),        
);

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";
