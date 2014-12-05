<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'Contract',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                     => DBModels::type('increments',
                                               array('visible' => false)),
    'is_deleted'             => DBModels::type('boolean',
                                               array('visible' => false)),
    'is_template'            => DBModels::type('boolean',
                                               array('visible' => false)),
    'template_name'          => DBModels::type('string',
                                               array('visible' => false)),
    'name'                   => DBModels::type('string'),
    'num'                    => DBModels::type('string'),
    'comment'                => DBModels::type('text'),
    'contract_type_id'        => DBModels::type('integer'),
    'begin_date'             => DBModels::type('date'),
    'duration'               => DBModels::type('integer'),
    'notice'                 => DBModels::type('integer'),
    'periodicity'            => DBModels::type('integer'),
    'billing'                => DBModels::type('integer'),
    'accounting_number'      => DBModels::type('string'),
    'week_begin_hour'        => DBModels::type('time'),
    'week_end_hour'          => DBModels::type('time'),
    'saturday_begin_hour'    => DBModels::type('time'),
    'saturday_end_hour'      => DBModels::type('time'),
    'use_saturday'           => DBModels::type('boolean'),
    'monday_begin_hour'      => DBModels::type('time'),
    'monday_end_hour'        => DBModels::type('time'),
    'use_monday'             => DBModels::type('boolean'),
    'max_links_allowed'      => DBModels::type('integer'),
    'alert'                  => DBModels::type('integer'),
    'renewal'                => DBModels::type('integer'),
);

$table['relationships'] = array(
    'contract_type' => array(
        'type' => 'belongsTo',
        'item' => 'ContractType'),
);

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";