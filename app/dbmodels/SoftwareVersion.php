<?php

$table = array(
    'fields'        => array(),
    'oldfields'     => array(),
    'renamefields'  => array(),
    'indexes'       => array(),
    'oldindexes'    => array(),
    'relationships' => array(),
    'model'         => 'SoftwareVersion',
    'menu'          => ''
);
$table['fields'] = array(
    'id'                        => DBModels::type('increments',
                                                  array('visible' => false)),
    'name'                      => DBModels::type('string'),
    'comment'                   => DBModels::type('text'),
    'software_id'               => DBModels::type('integer'),
    'states_id'  => DBModels::type('integer'),
    'operatingsystems_id'   => DBModels::type('integer'),
);

$table['relationships'] = array(
    'assets'     => array(
        'type'  => 'belongsToMany',
        'item'  => 'Asset',
        'linktable' => 'installed_software_versions',
        'linkfields' => array('is_deleted', 'is_dynamic', 'is_deleted_asset', 'is_template_asset')),
    'software' => array(
        'type' => 'belongsTo',
        'item' => 'Software'),
    'state' => array(
        'type' => 'belongsTo',
        'item' => 'State'),
    'operatingsystem' => array(
        'type' => 'belongsTo',
        'item' => 'OperatingSystem'),
);

include "_commonentitylink.php";
include "_commonrecursiveentitylink.php";
