<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Budget',
    'menu'          => 'Management'
);
$table['fields'] = array(
    'id'           => DBModels::type('increments',
                                     array('visible' => false)),
    'name'          => DBModels::type('string'),
    'comment'       => DBModels::type('text'),
    'entity_id'     => DBModels::type('integer'), ///TODO create relation
    'is_recursive'  => DBModels::type('boolean',
                                      array('visible' => false)),
    'is_deleted'    => DBModels::type('boolean',
                                      array('visible' => false)),
    'begin_date'    => DBModels::type('date'),
    'end_date'      => DBModels::type('date'),
    'value'         => DBModels::type('decimal'),
    'is_template'   => DBModels::type('boolean',
                                      array('visible' => false)),
    'template_name' => DBModels::type('string',
                                      array('visible' => false)),

);