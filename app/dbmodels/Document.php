<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Document',
    'menu'          => 'Management'
);
$table['fields'] = array(
    'id'                     => DBModels::type('increments',
                                               array('visible' => false)),
    'entity_id'              => DBModels::type('integer'),
    'is_recursive'           => DBModels::type('boolean',
                                               array('visible' => false)),
    'is_deleted'             => DBModels::type('boolean',
                                               array('visible' => false)),
    'name'                   => DBModels::type('string'),
    'filename'               => DBModels::type('string'),
    'filepath'               => DBModels::type('string'),
    'comment'                => DBModels::type('text'),
    'document_category_id'    => DBModels::type('integer'),
    'mime'                   => DBModels::type('string'),
    'link'                   => DBModels::type('string'),
    'users_id'               => DBModels::type('integer'),
    'tickets_id'             => DBModels::type('integer'), /// TODO manage relationships
    'sha1sum'                => DBModels::type('string'),
    'is_blacklisted'         => DBModels::type('boolean'),
    'tag'                    => DBModels::type('string'),
);

$table['relationships'] = array(
    'document_category' => array(
        'type' => 'belongsTo',
        'item' => 'DocumentCategory'),
    'user' => array(
        'type' => 'belongsTo',
        'item' => 'User'),
    'entity' => array(
        'type'  => 'belongsTo',
        'item'  => 'Entity'),
);
